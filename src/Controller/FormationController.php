<?php

namespace App\Controller;

use App\Entity\Formation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/formations")
 */
class FormationController extends AbstractController
{
    /**
     * @Route("/", name="formations_list")
     */
    public function index(): Response
    {

        $formations = $this->getDoctrine()->getRepository(Formation::class)->findAll();


        return $this->render('formation/index.html.twig', [
            "formations" => $formations
        ]);
    }
}
