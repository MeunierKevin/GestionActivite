<?php

namespace App\Controller\admin;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProjetController extends AbstractController
{
    /**
     * @Route("/admin/projet", name="admin_projet")
     */
    public function listeProjets(ProjetRepository $repository): Response
    {
        $projets = $repository->findAll();
        return $this->render('admin/projet/projet.html.twig',[
            'projets'=> $projets
        ]);
    }

    /**
     * @Route("/admin/projet/creation", name="admin_projet_creation")
     * @Route("/admin/projet/{id}", name="admin_projet_modification", methods="GET|POST")
     */
    public function ajouEtmodifProjet(Projet $projet = null, Request $request, EntityManagerInterface $entityManager){

        if(!$projet){
            $projet = new Projet();
        }
        $form = $this->createForm(ProjetType::class,$projet);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $modif = $projet->getId() !==null;
            $entityManager->persist($projet);
            $entityManager->flush();
            $this->addFlash("success",($modif)? "La modification du projet n° {$projet->getID()} a été effectué !":"L'ajout a été effectué");
            return $this->redirectToRoute("admin_projet");
        }
        return $this->render("admin/projet/modifEtAjoutProjet.html.twig",[
            "projet"=>$projet,
            "form"=>$form->createView(),
            "isModification"=>$projet->getId() !==null
        ]);
    }
        /**
         * @Route("/admin/projet/{id}", name="admin_projet_suppression", methods="delete")
         */
        public function supprProjet(Projet $projet,Request $request, EntityManagerInterface $entityManager ){
            if($this->isCsrfTokenValid("SUP". $projet->getId(),$request->get('_token'))){
                $entityManager->remove($projet);
                $entityManager->flush();
                $this->addFlash("success", "La suppression a été effectué");
                return $this->redirectToRoute("admin_projet");
            }
        }       
}
