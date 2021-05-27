<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use App\Form\StagiaireType;
use Container41XZVK4\getResponseService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
* @Route("/admin")
*/
class AdminKhawlaController extends AbstractController
{
    
     /**
    * @Route("/{id}/delete", name="stagiaire_delete_bdd")
    */
   public function delete_salarie_bdd(Stagiaire $stagiaire){
       $entityManager = $this->getDoctrine()->getManager();
       $entityManager->remove($stagiaire);
       $entityManager->flush();
         
       return $this->redirectToRoute('stagiaire');
   }

    /**
     * @Route("/add", name="session_add")
     * @Route("/edit/{id}", name="session_edit")
     */
    public function add_edit_session(Session $session = null, Request $request){
        //si la session n'existe pas, on instancie une nouvelle Session (on est dans le cas d'un ajout)
        if(!$session){
            $session = new Session();
        }

        //il faut créer un SessionType au préalable (php bin/console make:form)
        $form = $this->createForm(SessionType::class, $session);

        $form->handleRequest($request);
        //si on soumet le formulaire et que le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les données du formulaire
            $session = $form->getData();
            //on ajoute la nouvelle session
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();

            //on redirige vers la liste des formations (formations_list étant le nom de la route qui liste toutes les formations)
            return $this->redirectToRoute('formations_list');
           
      
        }
        /*on renvoie à la vue correspondante :
            -Le formulaire
            -Le booléen editMode (si vrai, on est dans le cas d'une édition sinon on est dans le cas d'un ajout)
        */
        return $this->render('admin_khawla/add_edit_session.html.twig', [
            'formSession' => $form->createView(),
            'editMode' => $session->getId() !== null
        ]);

    }

}
