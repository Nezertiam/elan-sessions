<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Doctrine\ORM\EntityRepository;
use App\Repository\StagiaireRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SessionStagiaireFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $session = $options["data"];
        $builder
            ->add("stagiaires", EntityType::class, [
                "class" => Stagiaire::class,
                "choice_label" => "displayName",
                "multiple" => true,
                "expanded" => true,
                "by_reference" => true,
                'query_builder' => function (StagiaireRepository $sr) use ($session) {
                    return $sr->queryToFindNotInSession($session);
                },
            ])
            ->add("ajouter", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
