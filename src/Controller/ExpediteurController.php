<?php

namespace App\Controller;

use App\Entity\Expediteur;
use App\Form\ExpediteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpediteurController extends AbstractController
{
    private $entityManager;

    public function  __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;

    }
    /**
     * @Route("/expediteur", name="expediteur")
     */
    public function index(Request $request): Response
    {
        $notification = null;
        $expediteur = new Expediteur();
        $form = $this->createForm(ExpediteurType::class, $expediteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $expediteur->setEtat(0);
            $this->entityManager->persist($expediteur);
            $this->entityManager->flush();
            $notification = "Votre demande a bien été enregistrée";


        }
        return $this->render('expediteur/index.html.twig', [
            'form'=>$form->createView(),
            'notification' => $notification
        ]);
    }
}
