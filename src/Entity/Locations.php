<?php

namespace App\Entity;

use App\Repository\LocationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationsRepository::class)]
class Locations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    private ?Voiture $voiture = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_de_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_de_fin = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $total_paiement = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $statut = null;

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

    public function getDateDeDebut(): ?\DateTimeInterface
    {
        return $this->date_de_debut;
    }

    public function setDateDeDebut(?\DateTimeInterface $date_de_debut): static
    {
        $this->date_de_debut = $date_de_debut;

        return $this;
    }

    public function getDateDeFin(): ?\DateTimeInterface
    {
        return $this->date_de_fin;
    }

    public function setDateDeFin(?\DateTimeInterface $date_de_fin): static
    {
        $this->date_de_fin = $date_de_fin;

        return $this;
    }

    public function getTotalPaiement(): ?string
    {
        return $this->total_paiement;
    }

    public function setTotalPaiement(?string $total_paiement): static
    {
        $this->total_paiement = $total_paiement;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
