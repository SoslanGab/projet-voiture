<?php

namespace App\Entity;

use App\Repository\TypeDommageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeDommageRepository::class)]
class TypeDommage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'damage_type')]
    private ?DommageVoiture $dommageVoiture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDommageVoiture(): ?DommageVoiture
    {
        return $this->dommageVoiture;
    }

    public function setDommageVoiture(?DommageVoiture $dommageVoiture): static
    {
        $this->dommageVoiture = $dommageVoiture;

        return $this;
    }
}
