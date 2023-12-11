<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $street_name = null;

    #[ORM\Column(length: 255)]
    private ?string $street_number = null;

    #[ORM\ManyToOne(inversedBy: 'addresses')]
    private ?City $city = null;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: User::class)]
    private Collection $child;

    public function __construct()
    {
        $this->child = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreetName(): ?string
    {
        return $this->street_name;
    }

    public function setStreetName(string $street_name): static
    {
        $this->street_name = $street_name;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->street_number;
    }

    public function setStreetNumber(string $street_number): static
    {
        $this->street_number = $street_number;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getChild(): Collection
    {
        return $this->child;
    }

    public function addChild(User $child): static
    {
        if (!$this->child->contains($child)) {
            $this->child->add($child);
            $child->setAddress($this);
        }

        return $this;
    }

    public function removeChild(User $child): static
    {
        if ($this->child->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getAddress() === $this) {
                $child->setAddress(null);
            }
        }

        return $this;
    }
}
