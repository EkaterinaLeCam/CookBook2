<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    private ?Utilisateur $nomUtilisateur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDePublication = null;

    /**
     * @var Collection<int, Recette>
     */
    #[ORM\OneToMany(targetEntity: Recette::class, mappedBy: 'commentaires')]
    private Collection $recette;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $texteCommentaire = null;

    /**
     * @var Collection<int, TableDeReponses>
     */
    #[ORM\OneToMany(targetEntity: TableDeReponses::class, mappedBy: 'commentaire')]
    private Collection $tableDeReponses;

    public function __construct()
    {
        $this->recette = new ArrayCollection();
        $this->tableDeReponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUtilisateur(): ?Utilisateur
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(?Utilisateur $nomUtilisateur): static
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    public function getDateDePublication(): ?\DateTimeInterface
    {
        return $this->dateDePublication;
    }

    public function setDateDePublication(\DateTimeInterface $dateDePublication): static
    {
        $this->dateDePublication = $dateDePublication;

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecette(): Collection
    {
        return $this->recette;
    }

    public function addRecette(Recette $recette): static
    {
        if (!$this->recette->contains($recette)) {
            $this->recette->add($recette);
            $recette->setCommentaires($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): static
    {
        if ($this->recette->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getCommentaires() === $this) {
                $recette->setCommentaires(null);
            }
        }

        return $this;
    }

    public function getTexteCommentaire(): ?string
    {
        return $this->texteCommentaire;
    }

    public function setTexteCommentaire(string $texteCommentaire): static
    {
        $this->texteCommentaire = $texteCommentaire;

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
            $tableDeReponse->setCommentaire($this);
        }

        return $this;
    }

    public function removeTableDeReponse(TableDeReponses $tableDeReponse): static
    {
        if ($this->tableDeReponses->removeElement($tableDeReponse)) {
            // set the owning side to null (unless already changed)
            if ($tableDeReponse->getCommentaire() === $this) {
                $tableDeReponse->setCommentaire(null);
            }
        }

        return $this;
    }
}
