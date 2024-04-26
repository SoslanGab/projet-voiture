<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\ClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Client implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $nom_utilisateur = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $mot_de_pass = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $derniere_connexion = null;

    #[ORM\Column(nullable: true)]
    private ?bool $email_verifie = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $permisRectoPath = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $permisVersoPath = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Locations::class)]
    private Collection $locations;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column]
    private array $roles = [];

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(?string $nom_utilisateur): self
    {
        $this->nom_utilisateur = $nom_utilisateur;
        return $this;
    }

    public function getMotDePass(): ?string
    {
        return $this->mot_de_pass;
    }

    public function setMotDePass(?string $mot_de_pass): self
    {
        $this->mot_de_pass = $mot_de_pass;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getDerniereConnexion(): ?\DateTimeInterface
    {
        return $this->derniere_connexion;
    }

    public function setDerniereConnexion(?\DateTimeInterface $derniere_connexion): self
    {
        $this->derniere_connexion = $derniere_connexion;
        return $this;
    }

    public function isEmailVerifie(): ?bool
    {
        return $this->email_verifie;
    }

    public function setEmailVerifie(?bool $email_verifie): self
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

  
     /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->getMotDePass();
    }

    public function getSalt()
    {
        return null; 
    }

    public function getUsername(): string
    {
        return $this->getNomUtilisateur();
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
        
    }

    /**
     * @return Collection<int, Locations>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Locations $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setClient($this);
        }

        return $this;
    }

    public function removeLocation(Locations $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getClient() === $this) {
                $location->setClient(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
