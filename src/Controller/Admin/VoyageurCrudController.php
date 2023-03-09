<?php

namespace App\Controller\Admin;

use App\Entity\Voyageur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VoyageurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voyageur::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('villeDepart'),
            TextField::new('villeArrivee'),
            TextField::new('compagnieDeVoyage')->onlyOnDetail(),
            DateField::new('dateHeureDepart')->onlyOnDetail(),
            DateField::new('dateHeureArrivee')->onlyOnDetail(),
            IntegerField::new('kiloDisponible'),
            MoneyField::new('prixAchat')->setCurrency('EUR')->onlyOnDetail(),
            IntegerField::new('numero')->onlyOnDetail(),
            AssociationField::new('proprietaireDuColis'),
            TextEditorField::new('notification')->onlyOnDetail(),
            BooleanField::new('status')

        ];
    }

}
