<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    #[ORM\Column(length: 70)]
    private ?string $prenom = null;

    /**
     * @var Collection<int, NotePlat>
     */
    #[ORM\OneToMany(targetEntity: NotePlat::class, mappedBy: 'nomUtilisateur')]
    private Collection $notePlats;

    /**
     * @var Collection<int, Commentaire>
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'nomUtilisateur')]
    private Collection $commentaires;

    /**
     * @var Collection<int, TableDeReponses>
     */
    #[ORM\OneToMany(targetEntity: TableDeReponses::class, mappedBy: 'nomUtilisateur')]
    private Collection $tableDeReponses;

    public function __construct()
    {
        $this->notePlats = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->tableDeReponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, NotePlat>
     */
    public function getNotePlats(): Collection
    {
        return $this->notePlats;
    }

    public function addNotePlat(NotePlat $notePlat): static
    {
        if (!$this->notePlats->contains($notePlat)) {
            $this->notePlats->add($notePlat);
            $notePlat->setNomUtilisateur($this);
        }

        return $this;
    }

    public function removeNotePlat(NotePlat $notePlat): static
    {
        if ($this->notePlats->removeElement($notePlat)) {
            // set the owning side to null (unless already changed)
            if ($notePlat->getNomUtilisateur() === $this) {
                $notePlat->setNomUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setNomUtilisateur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getNomUtilisateur() === $this) {
                $commentaire->setNomUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TableDeReponses>
     */
    public function getTableDeReponses(): Collection
    {
        return $this->tableDeReponses;
    }

    public function addTableDeReponse(TableDeReponses $tableDeReponse): static
    {
        if (!$this->tableDeReponses->contains($tableDeReponse)) {
            $this->tableDeReponses->add($tableDeReponse);
            $tableDeReponse->setNomUtilisateur($this);
        }

        return $this;
    }

    public function removeTableDeReponse(TableDeReponses $tableDeReponse): static
    {
        if ($this->tableDeReponses->removeElement($tableDeReponse)) {
            // set the owning side to null (unless already changed)
            if ($tableDeReponse->getNomUtilisateur() === $this) {
                $tableDeReponse->setNomUtilisateur(null);
            }
        }

        return $this;
    }
}
