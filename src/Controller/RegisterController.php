<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function  __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;

    }

    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $notification = null;
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if(!$search_email){

                $user->setPassword($password = $encoder->encodePassword($user,$form->get("password")->getData()));
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $email = new Mail();
                $content = "Bonjour ".$user->getLastname()." <br/><br/> , Nous sommes heureux de vous comptez parmi nous ! <br/><br/> à très bientôt sur COPAVIA.";
                $email->send($user->getEmail(),$user->getLastname(),'Bienvenue sur COPAVIA',$content);

                $notification = "Votre demande a bien été enregistrée, Vous pouvez maintenant vous connectez pour la suite";
            }else{
                $notification = "Cette adresse e-mail est déjà utilisée, si vous avez un compte veuillez vous connectez";
            }



        }



        return $this->render('register/index.html.twig', [
            'form'=>$form->createView(),
            'notification' => $notification
        ]);
    }
}
