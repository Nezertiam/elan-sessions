<?php

namespace App\Form;

use App\Entity\Domaine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DomaineFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                "attr" => [
                    "placeholder" => "Nom du domaine",
                    'class' => 'uk-input'
                ]
            ])
            ->add("submit", SubmitType::class, [
                'attr' =>['class' =>'uk-button uk-button-secondary uk-margin-top']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Domaine::class,
        ]);
    }
}
