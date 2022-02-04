<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LocaleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocaleRepository::class)]
#[ApiResource]
class Locale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $iso;

    #[ORM\OneToMany(mappedBy: 'locale', targetEntity: Country::class, orphanRemoval: true)]
    private $countries;

    #[ORM\OneToMany(mappedBy: 'locale', targetEntity: Vat::class, orphanRemoval: true)]
    private $vats;

    public function __construct()
    {
        $this->countries = new ArrayCollection();
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

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function setIso(string $iso): self
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * @return Collection|Country[]
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    public function addCountry(Country $country): self
    {
        if (!$this->countries->contains($country)) {
            $this->countries[] = $country;
            $country->setLocale($this);
        }

        return $this;
    }

    public function removeCountry(Country $country): self
    {
        if ($this->countries->removeElement($country)) {
            // set the owning side to null (unless already changed)
            if ($country->getLocale() === $this) {
                $country->setLocale(null);
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
            $vat->setLocale($this);
        }

        return $this;
    }

    public function removeVat(Vat $vat): self
    {
        if ($this->vats->removeElement($vat)) {
            // set the owning side to null (unless already changed)
            if ($vat->getLocale() === $this) {
                $vat->setLocale(null);
            }
        }

        return $this;
    }
}
