<?php

namespace App\Form;

use App\Entity\Voyageur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class VoyageurType extends AbstractType
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
            ->add('villeDepart', TextType::class, [
                'label' => 'Ville de départ',
                'constraints' => new Length(3,2,30),
                'attr' => [
                    'placeholder' => 'Ville de départ'
                ]
            ])
            ->add('villeArrivee', TextType::class, [
                'label' => 'Ville de destination',
                'constraints' => new Length(3,2,30),
                'attr' => [
                    'placeholder' => 'Ville de destination'
                ]
            ])
            ->add('compagnieDeVoyage', TextType::class, [
                'label' => 'Compagnie de voyage',
                'constraints' => new Length(3,2,30),
                'attr' => [
                    'placeholder' => 'Compagnie de voyage'
                ]
            ])
            ->add('dateHeureDepart', DateTimeType::class,  [
                'format' => 'dd/MM/yyyy',
                'html5'  => false,
                'widget' => 'single_text',
                'input' => 'datetime',
                'label' => 'Date de départ (jj/mm/aaaa)',
            ] )
            ->add('dateHeureArrivee', DateTimeType::class,  [
                'format' => 'dd/MM/yyyy',
                'html5'  => false,
                'widget' => 'single_text',
                'input' => 'datetime',
                'label' => 'Date d\'arrivée (jj/mm/aaaa)',
            ])

            ->add('numero', TextType::class, [
                'label' => 'Portable',
                'constraints' => new Length(3,2,30),
                'attr' => [
                    'placeholder' => 'Portable'
                ]
            ])
            ->add('kiloDisponible', TextType::class, [
                'label' => 'Nombre de kilogramme disponible',
                'constraints' => new Length(3,2,30),
                'attr' => [
                    'placeholder' => 'Nombre de kilogramme disponible'
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
            'data_class' => Voyageur::class,
        ]);
    }
}
