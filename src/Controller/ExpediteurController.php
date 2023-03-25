<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Expediteur;
use App\Entity\User;
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
            $user = $form->getData();

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if(!$search_email){

                $expediteur->setEtat(0);
            $this->entityManager->persist($expediteur);
            $this->entityManager->flush();

            $email = new Mail();
            $content = "Bonjour ".$user->getLastname().", <br/><br/>Votre envoie a bien été pris en compte Un conseiller vous contactera dans les plus bref délais.<br/><br/> À très bientôt sur COPAVIA.";
            $email->send($user->getEmail(),$user->getLastname(),'Envoie enregistré',$content);

            $notification = "Votre demande a bien été enregistrée,";
        }else{
            $notification = "Un Problème c'est produit veuillez ressayer ";
        }

    }
        return $this->render('expediteur/index.html.twig', [
            'form'=>$form->createView(),
            'notification' => $notification
        ]);
    }
}
