<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Domaine;
use App\Entity\Formation;
use App\Form\DomaineFormType;
use App\Form\FormationFormType;
use App\Form\FormationModuleFormType;
use App\Form\ModuleFormType;
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
        $modify = false;

        if (!$formation) {
            $formation = new Formation();
        } else {
            $modify = true;
        }

        $form = $this->createForm(FormationFormType::class, $formation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formation = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute("formation_managemodules", ["id" => $formation->getId()]);
        }

        return $this->render('formation/add_edit.html.twig', [
            "form" => $form->createView(),
            "modify" => $modify
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





    // -------------------- MODS -------------------------------------------------

    /**
     * @Route("/formations/listmodules", name="modules_list")
     */
    public function modules_list()
    {
        $modules = $this->getDoctrine()->getRepository(Module::class)->findAll();

        return $this->render("module/index.html.twig", [
            "modules" => $modules
        ]);
    }

    /**
     * @Route("/formations/createmodule", name="formation_createmodule")
     * @Route("/formations/editmodule/{id}", name="edit_module")
     */
    public function formation_createmodule(Request $request, Module $mod = null)
    {
        $modify = false;

        if (!$mod) {
            $mod = new Module();
        } else {
            $modify = true;
        }

        $form = $this->createForm(ModuleFormType::class, $mod);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $mod = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mod);
            $entityManager->flush();

            return $this->redirectToRoute("modules_list");
        }

        return $this->render("module/createmodule.html.twig", [
            "form" => $form->createView(),
            "modify" => $modify
        ]);
    }

    /**
     * @Route("/formations/removemodule/{id}", name="delete_module")
     */
    public function delete_module(Module $module)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($module);
        $entityManager->flush();

        return $this->redirectToRoute('modules_list');
    }

    /**
     * @Route("/formations/managemodule/{id}", name="formation_managemodules")
     */
    public function formation_managemodules(Formation $formation, Request $request)
    {
        $form = $this->createForm(FormationModuleFormType::class, $formation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute("show_formation");
        }

        return $this->render("module/managemodules.html.twig", [
            "formation" => $formation,
            "form" => $form->createView()
        ]);
    }



    // ---------------------------------------------------------------------------





    // ---------------- DOMAINES -------------------------------------------------

    /**
     * @Route("/formations/domaines/add", name="add_domaine")
     * @Route("/formations/domaines/edit/{id}", name="edit_domaine")
     */
    public function add_edit_domaine(Domaine $domaine = null, Request $request)
    {
        $modify = false;

        if (!$domaine) {
            $domaine = new Domaine();
        } else {
            $modify = true;
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

        $dominos = $modify ? $domaine->getNom() : "";

        return $this->render('domaine/add_edit.html.twig', [
            "form" => $form->createView(),
            "modify" => $modify,
            "domaine" => $dominos
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



    // ----------------------------------------------------------------------


}
