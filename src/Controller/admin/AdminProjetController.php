<?php

namespace App\Controller\admin;

use App\Entity\Image;
use App\Entity\Projet;
use App\Form\ImageType;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
            //on récupère les images transmises
            $images = $form->get('images')->getData();
            //on boucle sur les images
            foreach($images as $image){
                // on génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();

                //on copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                //on stocke l'image dans la base de données(son url)
                $img = new Image();
                $img->setUrlImage($fichier);
                $projet->addImage($img);
            }

            $modif = $projet->getId() !==null;
            $entityManager->persist($projet);
            $entityManager->flush();
            $this->addFlash("success",($modif)? "La modification du projet n° {$projet->getID()} a été effectué !":"L'ajout a été effectué");
            return $this->redirectToRoute("admin_projet");
        }
        return $this->render("admin/projet/modifEtAjoutProjet.html.twig",[
            "projet"=>$projet,
            "form"=>$form->createView(),
            "isModification"=>$projet->getId() !==null,
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

        
        /**
         * @Route("admin/supprime/image/{id}", name="supprimer_image", methods="DELETE")
         */
        public function supprimeImage(Image $image, Request $request,EntityManagerInterface $entityManager){
            $data = json_decode($request->getContent(), true);
            //on vérifie si le token est valide
            if($this->isCsrfTokenValid('delete'.$image->getId(),$data['_token'])){
                //on récupère le nom de l'image
                $nom = $image->getUrlImage();
                //on supprime le fichier
                unlink($this->getParameter('images_directory').'/'.$nom);
                //on  supprime de la base
                $entityManager->remove($image);
                $entityManager->flush();
                //on répond en json 
                return new JsonResponse(['success'=>1]);
            }else{
                return new JsonResponse(['error'=>'token invalide'],400);
            }
        }

        /**
         * @Route("admin/projet/export", name="admin_projet_export")
         */
        public function exportProjet(){
            $projets = array (
                array('aaa', 'bbb', 'ccc', 'dddd'),
                array('123', '456', '789'),
                array('"aaa"', '"bbb"')
                );

                $fp = fopen('projets.csv', 'w');

                foreach ($projets as $fields) {
                    fputcsv($fp, $fields);
                }
                fclose($fp);
        }
        
}
