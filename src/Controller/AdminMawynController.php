<?php

namespace App\Controller;

use App\Entity\Formation;
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

        return $this->render('admin_mawyn/add_edit.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
