<?php

namespace App\Form;

use App\Entity\Collaborateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                "attr" => [
                    "placeholder" => "Email",
                    'class' => 'uk-input'
                ]
            ])
            ->add("nom", TextType::class, [
                "attr" => [
                    "placeholder" => "Nom du collaborateur",
                    'class' => 'uk-input'
                ]
            ])
            ->add("prenom", TextType::class, [
                "attr" => [
                    "placeholder" => "Prénom du collaborateur",
                    'class' => 'uk-input'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                "type" => PasswordType::class,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'options' => [
                    'attr' => [
                        'class' => 'password-field'
                    ]
                ],
                'required' => true,
                'first_options' => [
                    'attr' => [
                        'class' => "uk-input",
                        "placeholder" => "Mot de passe"
                    ]
                ],
                'second_options' => [
                    'attr' => [
                        'class' => "uk-input",
                        "placeholder" => "Confirmer mot de passe"
                    ]
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Collaborateur::class,
        ]);
    }
}
