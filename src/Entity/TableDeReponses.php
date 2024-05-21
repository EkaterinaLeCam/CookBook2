<?php

namespace App\Entity;

use App\Repository\TableDeReponsesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TableDeReponsesRepository::class)]
class TableDeReponses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tableDeReponses')]
    private ?Utilisateur $nomUtilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'tableDeReponses')]
    private ?Commentaire $commentaire = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $reponse = null;

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

    public function getCommentaire(): ?Commentaire
    {
        return $this->commentaire;
    }

    public function setCommentaire(?Commentaire $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): static
    {
        $this->reponse = $reponse;

        return $this;
    }
}
