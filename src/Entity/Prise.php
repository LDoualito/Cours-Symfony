<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Prise
{
    #[Assert\NotBlank(message: "Merci d'indiquer l'espèce du poisson.")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "L'espèce doit contenir au moins {{ limit }} caractères.",
        maxMessage: "L'espèce ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $espece = null;

    #[Assert\NotBlank(message: "Merci d'indiquer le poids de la prise.")]
    #[Assert\Positive(message: "Le poids doit être supérieur à zéro.")]
    private ?float $poids = null;

    #[Assert\NotBlank(message: "Merci d'indiquer le lieu de pêche.")]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: "Le lieu doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le lieu ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $lieu = null;

    #[Assert\NotBlank(message: "Merci d'indiquer la date de la prise.")]
    #[Assert\LessThanOrEqual(
        value: "today",
        message: "La date de la prise ne peut pas être dans le futur."
    )]
    private ?\DateTimeInterface $date = null;

    #[Assert\Length(
        max: 500,
        maxMessage: "Le commentaire ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $commentaire = null;

    private bool $record = false;

    public function getEspece(): ?string
    {
        return $this->espece;
    }

    public function setEspece(?string $espece): static
    {
        $this->espece = $espece;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(?float $poids): static
    {
        $this->poids = $poids;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function isRecord(): bool
    {
        return $this->record;
    }

    public function setRecord(bool $record): static
    {
        $this->record = $record;

        return $this;
    }
}
