<?php

namespace App\Controller;

use App\Entity\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/session")
 */
class SessionController extends AbstractController
{
    /**
     * @Route("/", name="session_list")
     */
    public function index(): Response
    {
        $sessions = $this->getDoctrine()->getRepository(Session::class)->findAll();

        return $this->render('session/index.html.twig', [
            "sessions" => $sessions,
        ]);
    }
}
