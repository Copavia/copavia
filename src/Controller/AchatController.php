<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Achat;
use App\Entity\User;
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
            $user = $form->getData();

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if(!$search_email){


                $this->entityManager->persist($achat);
                $this->entityManager->flush();

                $email = new Mail();
                $content = "Bonjour ".$user->getLastname().", <br/><br/>Votre achat a bien été pris en compte Un conseiller vous contactera dans les plus bref délais.<br/><br/> À très bientôt sur COPAVIA.";
                $email->send($user->getEmail(),$user->getLastname(),'Achat enregistré',$content);

                $notification = "Votre demande a bien été enregistrée,";
        }else{
                $notification = "Un Problème c'est produit veuillez ressayer ";
        }

        }

        return $this->render('achat/index.html.twig', [
            'form'=>$form->createView(),
            'notification' => $notification
        ]);
    }
}
