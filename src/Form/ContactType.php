<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom' , TextType::class, [
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
            ->add('objetContact', TextType::class, [
                'label' => 'Objet de votre demande',
                'attr' => [
                    'placeholder' => 'Objet ... '
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=> 'Votre mail',
                'attr' => [
                    'placeholder' => ' Email'
                ]
            ])
            ->add('numero', TextType::class, [
                'label' => 'Portable',
                'attr' => [
                    'placeholder' => 'Portable'
                ]
            ])
            ->add('commentaires',TextType::class, [
                'label' => 'Décrivez précisément le motif de votre prise de contact',
                'attr' => [
                    'placeholder' => 'Déscription ...'
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
            'data_class' => Contact::class,
        ]);
    }
}
