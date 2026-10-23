<?php

namespace App\Controller;

use App\Repository\SpotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SpotController extends AbstractController
{
    #[Route('/spots', name: 'app_spots')]
    public function liste(SpotRepository $spotRepository): Response
    {
        $spots = $spotRepository->findAll();

        return $this->render('spot/liste.html.twig', [
            'spots' => $spots,
        ]);
    }
}
