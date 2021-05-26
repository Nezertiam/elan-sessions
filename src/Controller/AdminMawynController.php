<?php

namespace App\Controller;

use App\Entity\Domaine;
use App\Entity\Formation;
use App\Form\DomaineFormType;
use App\Form\FormationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AdminMawynController extends AbstractController
{
    /**
     * @Route("/", name="admin_mawyn")
     */
    public function index(): Response
    {
        return $this->render('admin_mawyn/index.html.twig', [
            'controller_name' => 'AdminMawynController',
        ]);
    }



    // ---------------- FORMATIONS -------------------------------------------------

    /**
     * @Route("/formations/add", name="add_formation")
     * @Route("/formations/edit/{id}", name="edit_formation")
     */
    public function add_edit_formation(Formation $formation = null, Request $request): Response
    {
        if (!$formation) {
            $formation = new Formation();
        }

        $form = $this->createForm(FormationFormType::class, $formation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formation = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute("formations_list");
        }

        return $this->render('formation/add_edit.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/formations/remove/{id}", name="remove_formation")
     */
    public function remove_formation(Formation $formation)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($formation);
        $em->flush();

        return $this->redirectToRoute("formations_list");
    }

    // ---------------------------------------------------------------------------





    // ---------------- DOMAINES -------------------------------------------------

    /**
     * @Route("/formations/domaines/add", name="add_domaine")
     * @Route("/formations/domaines/edit/{id}", name="edit_domaine")
     */
    public function add_edit_domaine(Domaine $domaine, Request $request)
    {
        if (!$domaine) {
            $domaine = new Domaine();
        }

        $form = $this->createForm(DomaineFormType::class, $domaine);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $domaine = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($domaine);
            $entityManager->flush();

            return $this->redirectToRoute("domaines_list");
        }

        return $this->render('domaine/add_edit.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/formations/domaines/remove/{id}", name="remove_domaine")
     */
    public function remove_domaine(Domaine $domaine)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($domaine);
        $em->flush();

        return $this->redirectToRoute("domaines_list");
    }
}
