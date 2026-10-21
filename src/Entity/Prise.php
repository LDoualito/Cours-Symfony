<?php

namespace App\Entity;

use App\Repository\PriseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PriseRepository::class)]
class Prise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Merci d'indiquer l'espèce du poisson.")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "L'espèce doit contenir au moins {{ limit }} caractères.",
        maxMessage: "L'espèce ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $espece = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Merci d'indiquer le poids de la prise.")]
    #[Assert\Positive(message: "Le poids doit être supérieur à zéro.")]
    private ?float $poids = null;

    #[ORM\ManyToOne(inversedBy: 'prises')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: "Merci de choisir un spot de pêche.")]
    private ?Spot $spot = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "Merci d'indiquer la date de la prise.")]
    #[Assert\LessThanOrEqual(
        value: "today",
        message: "La date de la prise ne peut pas être dans le futur."
    )]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        max: 500,
        maxMessage: "Le commentaire ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $commentaire = null;

    #[ORM\Column]
    private bool $record = false;

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getSpot(): ?Spot
    {
        return $this->spot;
    }

    public function setSpot(?Spot $spot): static
    {
        $this->spot = $spot;

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
