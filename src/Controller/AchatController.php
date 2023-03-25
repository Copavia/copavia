<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Form\AchatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AchatController extends AbstractController
{
    private $entityManager;

    public function  __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;

    }
    /**
     * @Route("/achat", name="achat")
     */
    public function index(Request $request): Response
    {
        $notification = null;
        $achat = new Achat();
        $form = $this->createForm(AchatType::class, $achat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

                $this->entityManager->persist($achat);
                $this->entityManager->flush();


        }

        return $this->render('achat/index.html.twig', [
            'form'=>$form->createView(),
            'notification' => $notification
        ]);
    }
}
