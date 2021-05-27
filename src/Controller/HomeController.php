<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $sessionRepository = $this->getDoctrine()->getRepository(Session::class);
        $sessions =$sessionRepository->findBy([],['dateDebut' => 'DESC'], 3);
        $nbrSessions = $sessionRepository->countSessions();

     

        $nbrStagiaires = $this->getDoctrine()->getRepository(Stagiaire::class)->countStagiaires();

        

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'sessions' => $sessions,
            'nbrSessions' => $nbrSessions,
            'nbrStagiaires' => $nbrStagiaires,

        
        ]);
    }
  

}
