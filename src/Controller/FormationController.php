<?php

namespace App\Controller;

use App\Entity\Domaine;
use App\Entity\Session;
use App\Entity\Formation;
use App\Form\SessionStagiaireFormType;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/show/{id}", name="show_formation")
     */
    public function show_formation(Formation $formation): Response
    {
        return $this->render('formation/show.html.twig', [
            "formation" => $formation,
        ]);
    }








    // ---------------------------- DOMAINES -------------------------------------------------



    /**
     * @Route("/domaines", name="domaines_list")
     */
    public function domaines_list(): Response
    {

        $domaines = $this->getDoctrine()->getRepository(Domaine::class)->findAll();

        return $this->render('domaine/index.html.twig', [
            "domaines" => $domaines
        ]);
    }

    /**
     * @Route("/domaines/show/{id}", name="show_domaine")
     */
    public function show_domaine(Domaine $domaine): Response
    {
        return $this->render('domaine/show.html.twig', [
            "domaine" => $domaine
        ]);
    }











    // -------------------------- SESSIONS -------------------------------------

    /**
     * @Route("/sessions/show/{id}", name="show_session")
     */
    public function show_session(Session $session, Request $request): Response
    {
        /*$form = $this->createForm(SessionStagiaireFormType::class, $session);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            //$entityManager->flush();

            return $this->redirectToRoute("show_session", ["id" => $session->getId()]);
        }*/

        return $this->render('session/show.html.twig', [
            "session" => $session,
            //"form" => $form->createView()
        ]);
    }

    /**
     * @Route("/sessions/manage/{id}", name="manage_session")
     */
    public function manage_session(Session $session): Response
    {
        return $this->render('session/manage.html.twig', [
            "session" => $session
        ]);
    }
}
