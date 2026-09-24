<?php

namespace App\Controller;

use App\Entity\Prise;
use App\Form\PriseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PriseController extends AbstractController
{
    #[Route('/prises/nouvelle', name: 'app_prise_nouvelle')]
    public function nouvelle(Request $request): Response
    {
        $prise = new Prise();
        $form = $this->createForm(PriseType::class, $prise);

        $form->handleRequest($request);

        $confirmation = null;

        if ($form->isSubmitted() && $form->isValid()) {
            dump($prise);

            $confirmation = sprintf(
                'Prise enregistrée : %s de %s kg à %s.',
                $prise->getEspece(),
                $prise->getPoids(),
                $prise->getLieu()
            );

            $prise = new Prise();
            $form = $this->createForm(PriseType::class, $prise);
        }

        return $this->render('prise/nouvelle.html.twig', [
            'form' => $form,
            'confirmation' => $confirmation,
        ]);
    }
}
