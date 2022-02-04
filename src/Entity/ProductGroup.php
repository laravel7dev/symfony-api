<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductGroupRepository::class)]
#[ApiResource]
class ProductGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'product_group', targetEntity: Product::class, orphanRemoval: true)]
    private $products;

    #[ORM\OneToMany(mappedBy: 'product_group', targetEntity: Vat::class, orphanRemoval: true)]
    private $vats;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->vats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setProductGroup($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getProductGroup() === $this) {
                $product->setProductGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vat[]
     */
    public function getVats(): Collection
    {
        return $this->vats;
    }

    public function addVat(Vat $vat): self
    {
        if (!$this->vats->contains($vat)) {
            $this->vats[] = $vat;
            $vat->setProductGroup($this);
        }

        return $this;
    }

    public function removeVat(Vat $vat): self
    {
        if ($this->vats->removeElement($vat)) {
            // set the owning side to null (unless already changed)
            if ($vat->getProductGroup() === $this) {
                $vat->setProductGroup(null);
            }
        }

        return $this;
    }

    public function getVat($locale=Null)
    {
        return $this->getVats()->filter(function(Vat $vat) use ($locale) {
            if ($vat->getLocale()->getIso() == $locale)
                return true;
        });
    }
}
