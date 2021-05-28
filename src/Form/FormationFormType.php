<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Domaine;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FormationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', TextType::class, [
                "attr" => [
                    "placeholder" => "Intitulé de la formation",
                    'class' => 'uk-input'
                    
                ]
            ])
            ->add("domaine", EntityType::class, [
                "class" => Domaine::class,
                "choice_label" => "nom",
                'attr' => ['class' => 'uk-input '] 
            ])
            ->add("submit", SubmitType::class, [
                'attr' =>['class' =>'uk-button uk-button-secondary uk-margin-top']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
