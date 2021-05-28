<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Domaine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ModuleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                "attr" => [
                    "placeholder" => "Titre",
                    'class' => 'uk-input'
                    
                ]
            ])
            ->add('domaines', EntityType::class, [
                "class" => Domaine::class,
                "choice_label" => "nom",
                "multiple" => true,
                "expanded" => true,
                "by_reference" => false,
                'attr' => ['class' => 'uk-input '] 
            ])
            ->add("submit", SubmitType::class, [
                'attr' =>['class' =>'uk-button uk-button-secondary uk-margin-top']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
