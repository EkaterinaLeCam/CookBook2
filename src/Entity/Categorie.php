<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $nomCategorie = null;

    /**
     * @var Collection<int, Recette>
     */
    #[ORM\OneToMany(targetEntity: Recette::class, mappedBy: 'nomCategorie')]
    private Collection $nomRecettes;

    public function __construct()
    {
        $this->nomRecettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): static
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getNomRecettes(): Collection
    {
        return $this->nomRecettes;
    }

    public function addNomRecette(Recette $nomRecette): static
    {
        if (!$this->nomRecettes->contains($nomRecette)) {
            $this->nomRecettes->add($nomRecette);
            $nomRecette->setNomCategorie($this);
        }

        return $this;
    }

    public function removeNomRecette(Recette $nomRecette): static
    {
        if ($this->nomRecettes->removeElement($nomRecette)) {
            // set the owning side to null (unless already changed)
            if ($nomRecette->getNomCategorie() === $this) {
                $nomRecette->setNomCategorie(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNomCategorie();
    }
}
