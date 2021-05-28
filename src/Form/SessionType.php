<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                "attr" => [
                    "placeholder" => "Titre de la session",
                    'class' => 'uk-input' 
                ]
            ])
            ->add('nbrPlace', TextType::class, [
                "attr" => [
                    "placeholder" => "Nombre de places maximum",
                    'class' => 'uk-input'
                   
                ]
            ])
            ->add('dateDebut',DateType::class, [
                'attr' => ['class' => 'uk-input'], 
                'widget' => 'single_text',
            ])
            ->add('dateFin',DateType::class, [
                'attr' => ['class' => 'uk-input'], 
                'widget' => 'single_text',
            ])
            ->add('formation', EntityType::class, [
                'class' =>  Formation::class,
                "choice_label" => "intitule",
                "expanded" => true,
                'attr' => ['class' => 'uk-input '] 
            ])
            ->add('Valider', SubmitType::class, [
                'attr' =>['class' =>'uk-button uk-button-secondary uk-margin-top']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
