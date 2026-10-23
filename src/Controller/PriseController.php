<?php

namespace App\Controller;

use App\Entity\Prise;
use App\Form\PriseType;
use App\Repository\PriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PriseController extends AbstractController
{
    #[Route('/prises/nouvelle', name: 'app_prise_nouvelle')]
    public function nouvelle(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $prise = new Prise();
        $form = $this->createForm(PriseType::class, $prise);

        $form->handleRequest($request);

        $confirmation = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($prise);
            $em->flush();

            dump($prise);

            $confirmation = sprintf(
                'Prise enregistrée en base (id %d) : %s de %s kg à %s.',
                $prise->getId(),
                $prise->getEspece(),
                $prise->getPoids(),
                $prise->getSpot()->getNom()
            );

            $prise = new Prise();
            $form = $this->createForm(PriseType::class, $prise);
        }

        return $this->render('prise/nouvelle.html.twig', [
            'form' => $form,
            'confirmation' => $confirmation,
        ]);
    }

    #[Route('/prises', name: 'app_prises')]
    public function liste(PriseRepository $priseRepository): Response
    {
        $prises = $priseRepository->findAll();

        return $this->render('prise/liste.html.twig', [
            'prises' => $prises,
        ]);
    }


    #[Route('/prises/{id}/modifier', name: 'app_prise_modifier')]
    public function modifier(Prise $prise, Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(PriseType::class, $prise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_prises');
        }

        return $this->render('prise/modifier.html.twig', [
            'form' => $form,
            'prise' => $prise,
        ]);
    }

    #[Route('/prises/{id}/supprimer', name: 'app_prise_supprimer', methods: ['POST'])]
    public function supprimer(Prise $prise, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $em->remove($prise);
        $em->flush();

        return $this->redirectToRoute('app_prises');
    }

}
