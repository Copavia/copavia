<?php

namespace App\Form;

use App\Entity\Expediteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ExpediteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('villeDepart' ,TextType::class, [
        'label' => 'Ville de départ',
        'constraints' => new Length(3,2,30),
        'attr' => [
            'placeholder' => 'Ville de départ'
        ]
            ])
            ->add('villeArrivee',TextType::class, [
                'label' => 'Ville de destination',
                'constraints' => new Length(3,2,30),
                'attr' => [
                    'placeholder' => 'Ville de destination'
                ]
            ])
            ->add('dateDeVoyageSouhaiter', DateTimeType::class,  [
                'format' => 'dd/MM/yyyy',
                'html5'  => false,
                'widget' => 'single_text',
                'input' => 'datetime',
                'label' => 'Date souhaitée (jj/mm/aaaa)',
            ])
            ->add('nombreKilogramme',TextType::class, [
                'label' => 'Le poids de votre colis en Kg',
                'attr' => [
                    'placeholder' => 'Le poids de votre colis'
                ]
            ])
            ->add('descriptionColis',TextType::class, [
                'label' => 'Décrivez précisément  votre colis',
                'attr' => [
                    'placeholder' => 'Déscription ...'
                ]
            ])
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
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('numero', TextType::class, [
                'label' => 'Portable',
                'constraints' => new Length(3,2,30),
                'attr' => [
                    'placeholder' => 'Portable'
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=> 'Votre Mail',
                'constraints' => new Length(3,2,60),
                'attr' => [
                    'placeholder' => ' Email'
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
            'data_class' => Expediteur::class,
        ]);
    }
}
