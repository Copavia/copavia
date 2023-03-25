<?php

namespace App\Controller;

use App\Entity\Voyageur;
use App\Form\VoyageurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoyageurController extends AbstractController
{
    private $entityManager;

    public function  __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;

    }

    /**
     * @Route("/voyageur", name="voyageur")
     */
    public function index(Request $request): Response
    {
        $notification = null;
        $voyageur = new Voyageur();
        $form = $this->createForm(VoyageurType::class, $voyageur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $this->entityManager->persist($voyageur);
            $this->entityManager->flush();
        }

        return $this->render('voyageur/index.html.twig', [
                'form'=>$form->createView(),
            'notification' => $notification
        ]);
    }
}
