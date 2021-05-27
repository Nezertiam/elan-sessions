<?php

namespace App\Controller;

use App\Entity\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    /**
     * @Route("/session", name="session_list")
     */
    public function index(): Response
    {
        $sessions = $this->getDoctrine()->getRepository(Session::class)->findAll();

        return $this->render('formation/show.html.twig', [
            "sessions" => $sessions,
        ]);
    }

    

}