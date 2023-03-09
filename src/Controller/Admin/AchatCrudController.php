<?php

namespace App\Controller\Admin;

use App\Entity\Achat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AchatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Achat::class;
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
            TextField::new('produit')->onlyOnDetail(),
            TextField::new('referenceProduit')->onlyOnDetail(),
            TextField::new('lienDuProduit')->onlyOnDetail(),
            MoneyField::new('prixProduit')->setCurrency('EUR'),
            TextField::new('paysDeDestination')->onlyOnDetail(),
            TextField::new('email')->onlyOnDetail(),
            IntegerField::new('numero'),
            TextEditorField::new('notification'),
            BooleanField::new('status')
        ];
    }

}
