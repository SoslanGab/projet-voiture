<?php

namespace App\Entity;

use App\Repository\MaintenancevehiculeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaintenancevehiculeRepository::class)]
class Maintenancevehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?voiture $voiture = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nombre_km = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoiture(): ?voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?voiture $voiture): static
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getNombreKm(): ?string
    {
        return $this->nombre_km;
    }

    public function setNombreKm(?string $nombre_km): static
    {
        $this->nombre_km = $nombre_km;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }
}
