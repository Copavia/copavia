<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\ResetPasword;
use App\Entity\User;
use App\Form\ResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    private  $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/mot-de-passe-oublie", name="reset_password")
     */
    public function index(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        if ($request->get('email'))
        {
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));

            if($user)
            {
                // 1 : Enregistrement en base de la demande de reset_password avec user, token et createdAt
                $reset_password = new ResetPasword();
                $reset_password->setUser($user);
                $reset_password->setToken(uniqid());
                $reset_password->setcreatedAt(new \DateTime());
                $this->entityManager->persist($reset_password);
                $this->entityManager->flush();

                //2 : Envoyer un email a l'utilisateur avec un lien lui permettant de modifier son mot de passe
                $url = $this->generateUrl('update_password', [
                    'token' => $reset_password->getToken()
                ]);

                $content = "Bonjour ".$user->getLastname()." <br> Vous avez demandé à réinitilaiser votre mot de passe COPAVIA.<br><br>";
                $content .= "Merci de bien vouloir cliquer sur le lien suivant pour <a href='".$url."'>mettre a jour votre mot de passe</a>.";

                $email = new Mail();
                $email->send($user->getEmail(),$user->getLastname(),'Réinitialiser votre mot de passe sur COPAVIA ',$content);
                $this->addFlash('notice', 'Vous allez recevoir dans quelques secondes un mail avec un lien pour réinitialiser votre mot de passe');

            } else {
                $this->addFlash('notice', 'Cette adresse email est inconnue');
            }
        }
            return $this->render('reset_password/index.html.twig');
    }


    /**
     * @Route("/modifier-mon-mot-de-passe/{token}", name="update_password")
     */
    public function update (Request $request , $token , UserPasswordEncoderInterface $encoder)
    {
        $reset_password = $this->entityManager->getRepository(ResetPasword::class)->findOneByToken($token);
        if (!$reset_password)
        {
            return $this->redirectToRoute('reset_password');
        }
        // Vérifier si le createdAt = now -1h
        $now = new \DateTime();
        if($now > $reset_password->getCreatedAt()->modify('+ 1 hour'))
        {
            $this->addFlash('notice', 'Votre demande de mot de passe a expiré. Merci de la renouveler');
        }
        // Rendre une vue avec mot de passe et confirmez votre mot de passe.
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $new_pwd = $form->get('new_password')->getData();

            //Encodage des mots de passe
            $password = $encoder->encodePassword($reset_password->getUser(), $new_pwd);
            $reset_password->getUser()->setPassword($password);

            //flush en base de données
            $this->entityManager->flush();

            //Redirection de l'utilisateur vers la page de connexion
            $this->addFlash('notice', 'Votre Mot de passe a bien été mis à jour, vous pouvez dès à present vous connecter');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('reset_password/update.html.twig', [
            'form' => $form->createView()
        ]);




    }
}
