<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VatRepository::class)]
#[UniqueEntity(fields: ['product_group', 'locale'])]
#[ApiResource]
class Vat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    #[Assert\Length(
        min: 1,
        max: 20,
        minMessage: 'Value must be at least {{ limit }}',
        maxMessage: 'Value cannot be more than {{ limit }}',
    )]
    private $value;

    #[ORM\ManyToOne(targetEntity: ProductGroup::class, inversedBy: 'vats')]
    #[ORM\JoinColumn(nullable: false)]
    private $product_group;

    #[ORM\ManyToOne(targetEntity: Locale::class, inversedBy: 'vats')]
    #[ORM\JoinColumn(nullable: false)]
    private $locale;

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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getProductGroup(): ?ProductGroup
    {
        return $this->product_group;
    }

    public function setProductGroup(?ProductGroup $product_group): self
    {
        $this->product_group = $product_group;

        return $this;
    }

    public function getLocale(): ?Locale
    {
        return $this->locale;
    }

    public function setLocale(?Locale $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}
