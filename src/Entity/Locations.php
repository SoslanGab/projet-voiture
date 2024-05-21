<?php

namespace App\Entity;

use App\Repository\LocationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(type: 'string', length: 20, nullable: false)]
    private ?string $status = 'en attente';

    #[ORM\ManyToOne(inversedBy: 'locations')]
    private ?Client $client = null;

    #[ORM\OneToMany(mappedBy: 'location', targetEntity: SanctionsLocatives::class)]
    private Collection $sanctionsLocatives;

    public function __construct()
    {
        $this->sanctionsLocatives = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, SanctionsLocatives>
     */
    public function getSanctionsLocatives(): Collection
    {
        return $this->sanctionsLocatives;
    }

    public function addSanctionsLocative(SanctionsLocatives $sanctionsLocative): static
    {
        if (!$this->sanctionsLocatives->contains($sanctionsLocative)) {
            $this->sanctionsLocatives->add($sanctionsLocative);
            $sanctionsLocative->setLocation($this);
        }

        return $this;
    }

    public function removeSanctionsLocative(SanctionsLocatives $sanctionsLocative): static
    {
        if ($this->sanctionsLocatives->removeElement($sanctionsLocative)) {
            // set the owning side to null (unless already changed)
            if ($sanctionsLocative->getLocation() === $this) {
                $sanctionsLocative->setLocation(null);
            }
        }

        return $this;
    }
}
