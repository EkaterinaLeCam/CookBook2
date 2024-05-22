<?php

namespace App\Entity;
use App\Entity\Ingredient;
use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomRecette = null;

    #[ORM\ManyToOne(inversedBy: 'recettes', targetEntity: Ingredient::class, cascade:['persist'])]
    private ?Ingredient $Ingredient = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $preparation = null;

    #[ORM\ManyToOne(inversedBy: 'nomRecettes')]
    private ?Categorie $nomCategorie = null;

    #[ORM\Column(length: 20)]
    private ?string $tempsDeCuisson = null;

    #[ORM\Column(length: 30)]
    private ?string $tempsDePreparation = null;

    #[ORM\Column(length: 20)]
    private ?string $difficulte = null;

    #[ORM\Column(length: 100)]
    private ?string $pays = null;

    /**
     * @var Collection<int, NotePlat>
     */
    #[ORM\OneToMany(targetEntity: NotePlat::class, mappedBy: 'recette')]
    private Collection $notePlats;

    #[ORM\ManyToOne(inversedBy: 'recette')]
    private ?Commentaire $commentaires = null;

    public function __construct()
    {
        $this->notePlats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRecette(): ?string
    {
        return $this->nomRecette;
    }

    public function setNomRecette(string $nomRecette): static
    {
        $this->nomRecette = $nomRecette;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->Ingredient;
    }

    public function setIngredient(?Ingredient $Ingredient): static
    {
        $this->Ingredient = $Ingredient;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): static
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getNomCategorie(): ?Categorie
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(?Categorie $nomCategorie): static
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    public function getTempsDeCuisson(): ?string
    {
        return $this->tempsDeCuisson;
    }

    public function setTempsDeCuisson(string $tempsDeCuisson): static
    {
        $this->tempsDeCuisson = $tempsDeCuisson;

        return $this;
    }

    public function getTempsDePreparation(): ?string
    {
        return $this->tempsDePreparation;
    }

    public function setTempsDePreparation(string $tempsDePreparation): static
    {
        $this->tempsDePreparation = $tempsDePreparation;

        return $this;
    }

    public function getDifficulte(): ?string
    {
        return $this->difficulte;
    }

    public function setDifficulte(string $difficulte): static
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

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
            $notePlat->setRecette($this);
        }

        return $this;
    }

    public function removeNotePlat(NotePlat $notePlat): static
    {
        if ($this->notePlats->removeElement($notePlat)) {
            // set the owning side to null (unless already changed)
            if ($notePlat->getRecette() === $this) {
                $notePlat->setRecette(null);
            }
        }

        return $this;
    }

    public function getCommentaires(): ?Commentaire
    {
        return $this->commentaires;
    }

    public function setCommentaires(?Commentaire $commentaires): static
    {
        $this->commentaires = $commentaires;

        return $this;
    }
}
