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
                "by_reference" => false, // fait en sorte d'appeler setModules
               /* "query_builder" => function (EntityRepository $er) {

                    return $er->createQueryBuilder("s")
                        ->

                    
                    $query = $er->createQuery(
                        "SELECT s
                        FROM app\Entity\Stagiaire s
                        FULL OUTER JOIN s.sessions se
                        WHERE se.id = :id"
                    )->setParameter("id", $);
                } */
            ])
            ->add("submit", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
