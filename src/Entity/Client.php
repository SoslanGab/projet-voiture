<?php

namespace App\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

use App\Repository\ClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $nom_utilisateur = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $mot_de_pass = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    private ?int $telephone = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $derniere_connexion = null;

    #[ORM\Column(nullable: true)]
    private ?bool $email_verifie = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $permisRectoPath = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $permisVersoPath = null;


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getRoles(): array
    {
        // TODO: Implement getRoles() method. Pour simplifier, retourner un array de rôles. Ex: ['ROLE_USER']
        return ['ROLE_USER'];
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(?string $nom_utilisateur): static
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    public function getMotDePass(): ?string
    {
        return $this->mot_de_pass;
    }

    public function setMotDePass(?string $mot_de_pass): static
    {
        $this->mot_de_pass = $mot_de_pass;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDerniereConnexion(): ?\DateTimeInterface
    {
        return $this->derniere_connexion;
    }

    public function setDerniereConnexion(?\DateTimeInterface $derniere_connexion): static
    {
        $this->derniere_connexion = $derniere_connexion;

        return $this;
    }

    public function isEmailVerifie(): ?bool
    {
        return $this->email_verifie;
    }

    public function setEmailVerifie(?bool $email_verifie): static
    {
        $this->email_verifie = $email_verifie;

        return $this;
    }
    public function getPermisRectoPath(): ?string
    {
        return $this->permisRectoPath;
    }

    public function setPermisRectoPath(?string $permisRectoPath): self
    {
        $this->permisRectoPath = $permisRectoPath;
        return $this;
    }

    public function getPermisVersoPath(): ?string
    {
        return $this->permisVersoPath;
    }

    public function setPermisVersoPath(?string $permisVersoPath): self
    {
        $this->permisVersoPath = $permisVersoPath;
        return $this;
        
    }
}
