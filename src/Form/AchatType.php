<?php

namespace App\Form;

use App\Entity\Achat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class AchatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'constraints' => new Length(3,2,30),
                'attr' => [
                    'placeholder' => 'Votre nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom',
                'constraints' => new Length(3,2,30),
                'attr' => [
                    'placeholder' => 'Votre prénom'
                ]
            ])
            ->add('numero', TextType::class, [
                'label' => 'Portable',
                'attr' => [
                    'placeholder' => 'Portable'
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=> 'Votre mail',
                'attr' => [
                    'placeholder' => ' Email'
                ]
            ])
            ->add('produit', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => [
                    'placeholder' => 'Produit à acheter'
                ]
            ])
            ->add('referenceProduit', TextType::class, [
                'label' => 'Réference du produit',
                'attr' => [
                    'placeholder' => 'Réference du produit à acheter'
                ]
            ])
            ->add('lienDuProduit', TextType::class, [
                'label' => 'Lien du produit',
                'attr' => [
                    'placeholder' => 'Copiez et collez ici le lien du produit (site vendeur)'
                ]
            ])
            ->add('prixProduit', TextType::class, [
                'label' => 'Prix du produit',
                'attr' => [
                    'placeholder' => 'Indiquer le prix du produit '
                ]
            ])
            ->add('paysDeDestination', TextType::class, [
                'label' => 'Destination (Pays)',
                'attr' => [
                    'placeholder' => 'Indiquer le pays de livraison'
                ]
            ])
            ->add('Submit',SubmitType::class, [
                'label'=> "Envoyer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Achat::class,
        ]);
    }
}
