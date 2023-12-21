<?php

namespace App\Entity;

use App\Repository\AgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgeRepository::class)]
class Age
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\OneToMany(mappedBy: 'age', targetEntity: Gift::class)]
    private Collection $gifts;

    public function __construct()
    {
        $this->gifts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection<int, Gift>
     */
    public function getGifts(): Collection
    {
        return $this->gifts;
    }

    public function addGift(Gift $gift): static
    {
        if (!$this->gifts->contains($gift)) {
            $this->gifts->add($gift);
            $gift->setAge($this);
        }

        return $this;
    }

    public function removeGift(Gift $gift): static
    {
        if ($this->gifts->removeElement($gift)) {
            // set the owning side to null (unless already changed)
            if ($gift->getAge() === $this) {
                $gift->setAge(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->age;
    }
}
