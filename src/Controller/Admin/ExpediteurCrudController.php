<?php

namespace App\Controller\Admin;


use App\Classe\Mail;
use App\Entity\Expediteur;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class ExpediteurCrudController extends AbstractCrudController
{
    private $entityManager;
    private $crudUrlGenerator;
    public function __construct(EntityManagerInterface $entityManager, AdminUrlGenerator $crudUrlGenerator)
    {
        $this->entityManager = $entityManager;
        $this->crudUrlGenerator = $crudUrlGenerator;
    }


    public static function getEntityFqcn(): string
    {
        return Expediteur::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $updateExpediteur = Action::new('updateExpediteur','Envoie pris en charge','fas fa-box-open')->linkToCrudAction('updateExpediteur');
        $updateTransit = Action::new('updateTransit','En Transit','fas fa-truck')->linkToCrudAction('updateTransit');
        $updateRelais = Action::new('updateRelais','Reçu au relais','fas fa-dolly')->linkToCrudAction('updateRelais');
        $updateRetrait = Action::new('updateRetrait','Colis retiré','fas fa-solid fa-user-check')->linkToCrudAction('updateRetrait');
        return $actions
            ->add('detail',$updateExpediteur)
            ->add('detail',$updateTransit)
            ->add('detail',$updateRelais)
            ->add('detail',$updateRetrait)
            ->add('index', 'detail');
    }

    public  function updateExpediteur(AdminContext $context)
    {
       $expediteur = $context->getEntity()->getInstance();
       $expediteur->setEtat(1);
        $this->entityManager->flush();


        $this->addFlash('notice', "<span style='color: #0a58ca; font-size: 20px' xmlns=\"http://www.w3.org/1999/html\"><strong>L'envoie de   " .$expediteur->getNom()." <u>a bien été mis à jour</u>. </strong></span>");

        $url = $this->crudUrlGenerator
            ->setController(ExpediteurCrudController::class)
            ->setAction('index')
            ->generateUrl();
        $email = new Mail();
        $content = "Mr/Mme ".$expediteur->getNom()." Votre colis a bien été pris en charge. Il sera envoyé très prochainement. Merci de votre confiance";
        $email->send($expediteur->getEmail(),$expediteur->getNom(),'Colis pris en charge',$content);

        return $this->redirect($url);
    }

    public  function updateTransit(AdminContext $context)
    {
        $expediteur = $context->getEntity()->getInstance();
        $expediteur->setEtat(2);
        $this->entityManager->flush();


        $this->addFlash('notice', "<span style='color: #0a58ca; font-size: 20px' xmlns=\"http://www.w3.org/1999/html\"><strong>L'envoie de   " .$expediteur->getNom()." <u>a bien été mis à jour</u>. </strong></span>");

        $url = $this->crudUrlGenerator
            ->setController(ExpediteurCrudController::class)
            ->setAction('index')
            ->generateUrl();

        $email = new Mail();
        $content = "Mr/Mme ".$expediteur->getNom()." Votre colis est en transit. Il sera bientôt disponible pour le retrait. Merci de votre confiance.";
        $email->send($expediteur->getEmail(),$expediteur->getNom(),'Colis envoyé',$content);

        return $this->redirect($url);
    }

    public  function updateRelais(AdminContext $context)
    {
        $expediteur = $context->getEntity()->getInstance();
        $expediteur->setEtat(3);
        $this->entityManager->flush();


        $this->addFlash('notice', "<span style='color: #0a58ca; font-size: 20px' xmlns=\"http://www.w3.org/1999/html\"><strong>L'envoie de   " .$expediteur->getNom()." <u>a bien été mis à jour</u>. </strong></span>");

        $url = $this->crudUrlGenerator
            ->setController(ExpediteurCrudController::class)
            ->setAction('index')
            ->generateUrl();

        $email = new Mail();
        $content = "Mr/Mme ".$expediteur->getNom()." Votre colis est arrivé à sa destination. Vous pouvez dès à présent le retirer avec votre code retrait et une pièce d’identité. Merci de votre confiance.";
        $email->send($expediteur->getEmail(),$expediteur->getNom(),'Colis en point relais',$content);

        return $this->redirect($url);
    }

    public  function updateRetrait(AdminContext $context)
    {
        $expediteur = $context->getEntity()->getInstance();
        $expediteur->setEtat(4);
        $this->entityManager->flush();


        $this->addFlash('notice', "<span style='color: #0a58ca; font-size: 20px' xmlns=\"http://www.w3.org/1999/html\"><strong>L'envoie de   " .$expediteur->getNom()." <u>a bien été mis à jour</u>. </strong></span>");

        $url = $this->crudUrlGenerator
            ->setController(ExpediteurCrudController::class)
            ->setAction('index')
            ->generateUrl();

        $email = new Mail();
        $content = "Mr/Mme ".$expediteur->getNom()." Votre colis à bien été retiré. Garant de vos attaches, COPAVIA a été ravi de vous servir. Merci et à bientôt";
        $email->send($expediteur->getEmail(),$expediteur->getNom(),'Colis rétiré',$content);

        return $this->redirect($url);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            ChoiceField::new('etat')->setChoices([
                'Non validé'=>0,
                'Envoie pris en charge'=>1,
                'En transit'=>2,
                'Reçus au relais'=>3,
                'Colis retiré'=>4
            ]),
            TextField::new('VilleDepart'),
            TextField::new('villeArrivee'),
            DateField::new('dateDeVoyageSouhaiter'),
            IntegerField::new('nombreKilogramme'),
            MoneyField::new('prixEnvoie')->setCurrency('EUR'),
            AssociationField::new('transporteurDuColis'),
            TextField::new('email')->onlyOnDetail(),
            TextField::new('numero')->onlyOnDetail(),
            TextField::new('numeroCarteIdentite'),
            TextEditorField::new('descriptionColis')->onlyOnDetail(),
            TextEditorField::new('notification'),
            BooleanField::new('status')


        ];
    }

}
