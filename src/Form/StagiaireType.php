<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                "attr" => [
                    "placeholder" => "Nom du stagiaire",
                    'class' => 'uk-input'

                ]
            ])
            ->add('prenom', TextType::class, [
                "attr" => [
                    "placeholder" => "Prénom du stagiaire",
                    'class' => 'uk-input'
                ]
            ])
            ->add('mail', EmailType::class, [
                "attr" => [
                    "placeholder" => "Email",
                    'class' => 'uk-input'
                ]
            ])
            ->add('nde', TextType::class, [
                "required" => false,
                "attr" => [
                    "placeholder" => "Numero pole emploi",
                    'class' => 'uk-input'
                ]
            ])
            ->add('adresse', TextType::class, [
                "attr" => [
                    "placeholder" => "Adresse du stagiaire",
                    'class' => 'uk-input'
                ]
            ])
            ->add('cp', TextType::class, [
                "attr" => [
                    "placeholder" => "Code postal",
                    'class' => 'uk-input'
                ]
            ])
            ->add('ville', TextType::class, [
                "attr" => [
                    "placeholder" => "Ville",
                    'class' => 'uk-input'

                ]
            ])
            /*->add('sessions', EntityType::class, [
                'class' =>  Session::class,
                "choice_label" => "titre",
                "multiple" => true,
                "expanded" => true,
                "by_reference" => false,
                'attr' => ['class' => 'uk-input '] 
            ])*/
            ->add('Valider', SubmitType::class, [
                'attr' => ['class' => 'uk-button uk-button-secondary uk-margin-top']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
