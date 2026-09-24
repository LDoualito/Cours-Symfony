<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

final class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('poids', [$this, 'formatPoids']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('categorie_prise', [$this, 'categoriePrise']),
        ];
    }

    /**
     * Affiche un poids en grammes sous le kilo, en kilos au-dessus.
     */
    public function formatPoids(float $kg): string
    {
        if ($kg < 1) {
            return number_format($kg * 1000, 0, ',', ' ') . ' g';
        }

        return number_format($kg, 1, ',', ' ') . ' kg';
    }

    /**
     * Classe une prise selon son poids.
     */
    public function categoriePrise(float $kg): string
    {
        return match (true) {
            $kg >= 10 => 'Trophée',
            $kg >= 3 => 'Belle prise',
            default => 'Petite prise',
        };
    }
}
