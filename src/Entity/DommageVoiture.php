<?php

namespace App\Entity;

use App\Repository\DommageVoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DommageVoitureRepository::class)]
class DommageVoiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'dommageVoitures')]
    private ?Voiture $voiture = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'dommageVoiture', targetEntity: TypeDommage::class)]
    private Collection $damage_type;

    public function __construct()
    {
        $this->damage_type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): static
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, typedommage>
     */
    public function getDamageType(): Collection
    {
        return $this->damage_type;
    }

    public function addDamageType(typedommage $damageType): static
    {
        if (!$this->damage_type->contains($damageType)) {
            $this->damage_type->add($damageType);
            $damageType->setDommageVoiture($this);
        }

        return $this;
    }

    public function removeDamageType(typedommage $damageType): static
    {
        if ($this->damage_type->removeElement($damageType)) {
            // set the owning side to null (unless already changed)
            if ($damageType->getDommageVoiture() === $this) {
                $damageType->setDommageVoiture(null);
            }
        }

        return $this;
    }
}
