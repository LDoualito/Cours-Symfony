<?php

namespace App\Entity;

use App\Repository\SpotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SpotRepository::class)]
class Spot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Merci d'indiquer le nom du spot.")]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: "Le nom doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Merci d'indiquer le type de plan d'eau.")]
    private ?string $typeEau = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Prise>
     */
    #[ORM\OneToMany(mappedBy: 'spot', targetEntity: Prise::class)]
    private Collection $prises;

    public function __construct()
    {
        $this->prises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeEau(): ?string
    {
        return $this->typeEau;
    }

    public function setTypeEau(?string $typeEau): static
    {
        $this->typeEau = $typeEau;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Prise>
     */
    public function getPrises(): Collection
    {
        return $this->prises;
    }

    public function addPrise(Prise $prise): static
    {
        if (!$this->prises->contains($prise)) {
            $this->prises->add($prise);
            $prise->setSpot($this);
        }

        return $this;
    }

    public function removePrise(Prise $prise): static
    {
        if ($this->prises->removeElement($prise)) {
            if ($prise->getSpot() === $this) {
                $prise->setSpot(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom ?? '';
    }
}
