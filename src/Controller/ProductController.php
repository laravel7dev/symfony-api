<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;

class ProductController extends AbstractController
{
    /**
     * Product price by locale
     * @param integer $id Product id
     * @param string $locale Country locale
     */
    #[Route('/api/products/{id}/{locale}', name: 'product')]
    public function price(ManagerRegistry $doctrine, $id, $locale): Response
    {
        $product = $doctrine->getRepository(Product::class)->find($id);
        if(!$product)
            return $this->json(['error' => 'not found']);

        $vat = $product->getProductGroup()->getVat($locale);
        $rate = 0;
        if(!$vat->isEmpty())
            $rate = $vat->first()->getValue();

        $price = $product->getPrice() + $product->getPrice() * $rate / 100;

        return $this->json(['product' => $product->getName(),'price' => $price]);
    }
}
