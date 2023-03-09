<?php

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private $entityManager;

    public function  __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

        /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request): Response
    {
        $notification = null;
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            $this->entityManager->persist($contact);
            $this->entityManager->flush();
            $notification = "Merci !!! Votre demande a bien été prise en compte, Vous serais contacté, très vite";

        }

        return $this->render('contact/index.html.twig', [
            'form'=>$form->createView(),
            'notification' => $notification
        ]);
    }
}
