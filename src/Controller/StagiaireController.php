<?php

namespace App\Controller;

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
        ->findBy([],["prenom" => "DESC"]);

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

   

 
}
