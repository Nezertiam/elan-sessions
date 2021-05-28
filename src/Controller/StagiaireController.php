<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/stagiaire")
 */
class StagiaireController extends AbstractController
{
    /**
     * @Route("/", name="stagiaire")
     */
    public function index(): Response
    {
        $stagiaires = $this->getDoctrine()
            ->getRepository(Stagiaire::class)
            ->findBy([], ["nom" => "ASC"]);

        return $this->render('stagiaire/index.html.twig', [
            'controller_name' => 'StagiaireController',
            'stagiaires' => $stagiaires,
        ]);
    }

    /**
     * @Route("/show/{id}", name="stagiaire_show", methods="GET")
     */
    public function show(Stagiaire $stagiaire): Response
    {
        return $this->render('stagiaire/show.html.twig', [
            'stagiaire' => $stagiaire,
        ]);
    }

    /**
     * @Route("/add", name="stagiaire_add")
     * @Route("/edit/{id}", name="stagiaire_edit")
     */
    public function add_edit(Stagiaire $stagiaire = null, Request $request)
    {
        //si le stagiaire n'existe pas, on instancie un nouveau Stagiaire (on est dans le cas d'un ajout)
        if (!$stagiaire) {
            $stagiaire = new Stagiaire();
        }

        //il faut créer un StagiaireType au préalable (php bin/console make:form)
        $form = $this->createForm(StagiaireType::class, $stagiaire);

        $form->handleRequest($request);
        //si on soumet le formulaire et que le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les données du formulaire
            $stagiaire = $form->getData();
            $stagiaire->setNom(ucfirst($stagiaire->getNom()));
            $stagiaire->setPrenom(ucfirst($stagiaire->getPrenom()));
            $stagiaire->setDisplayName(strtoupper($stagiaire->getNom()) . " " . ucfirst($stagiaire->getPrenom()) . " (" . $stagiaire->getMail() . ")");
            //on ajoute le nouveau stagiaire
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stagiaire);
            $entityManager->flush();

            //on redirige vers la liste des stagiaires (stgiaire étant le nom de la route qui liste tous les stagiaires dans StagiaireController )
            return $this->redirectToRoute('stagiaire');
        }
        /*on renvoie à la vue correspondante :
            -Le formulaire
            -Le booléen editMode (si vrai, on est dans le cas d'une édition sinon on est dans le cas d'un ajout)
        */
        return $this->render('admin_khawla/add_edit.html.twig', [
            'formStagiaire' => $form->createView(),
            'editMode' => $stagiaire->getId() !== null
        ]);
    }
}
