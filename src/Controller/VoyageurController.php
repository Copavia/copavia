<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
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
            $user = $form->getData();

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if(!$search_email){


            $this->entityManager->persist($voyageur);
            $this->entityManager->flush();
                $email = new Mail();
                $content = "Bonjour ".$user->getLastname().", <br/><br/>Votre voyage a bien été pris en compte Un conseiller vous contactera dans les plus bref délais.<br/><br/> À très bientôt sur COPAVIA.";
                $email->send($user->getEmail(),$user->getLastname(),'Voyage enregistré',$content);

                $notification = "Votre demande a bien été enregistrée,";
            }else{
                $notification = "Un Problème c'est produit veuillez ressayer ";
            }
        }

        return $this->render('voyageur/index.html.twig', [
                'form'=>$form->createView(),
            'notification' => $notification
        ]);
    }
}
