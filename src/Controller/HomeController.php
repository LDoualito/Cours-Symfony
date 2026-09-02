<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }

    #[Route('/hello/{name}', name: 'app_hello')]
    public function hello(string $name): Response
    {
        return $this->render('home/hello.html.twig', [
            'name' => ucfirst($name),
        ]);
    }

    #[Route('/random', name: 'app_random')]
    public function random(): Response
    {
        $quotes = $this->getQuotes();

        return $this->render('home/random.html.twig', [
            'quote' => $quotes[array_rand($quotes)],
        ]);
    }

    #[Route('/api/random', name: 'app_api_random')]
    public function apiRandom(): JsonResponse
    {
        $quotes = $this->getQuotes();

        return $this->json([
            'quote' => $quotes[array_rand($quotes)],
        ]);
    }

    #[Route('/redirect', name: 'app_redirect')]
    public function redirectToRandom(): Response
    {
        return $this->redirectToRoute('app_random');
    }

    #[Route('/error', name: 'app_error')]
    public function error(): Response
    {
        throw $this->createNotFoundException('Cette page a été emportée par le courant.');
    }

    private function getQuotes(): array
    {
        return [
            "La pêche est une passion qui se vit au fil de l'eau.",
            "Le silence du lac est le meilleur compagnon du pêcheur.",
            "Chaque lancer est une nouvelle aventure.",
            "La patience est la clé de la réussite en pêche.",
            "Le bonheur se trouve au bout de la ligne.",
        ];
    }
}
