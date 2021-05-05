<?php

namespace App\Controller\admin;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminClientController extends AbstractController
{
    /**
     * @Route("/admin/client", name="admin_client")
     */
    public function listeClients(ClientRepository $repository): Response
    {
        $clients = $repository->findAll();
        return $this->render('admin/client/client.html.twig',[
            'clients'=> $clients
        ]);
    }

    /**
     * @Route("/admin/client/creation", name="admin_client_creation")
     * @Route("/admin/client/{id}", name="admin_client_modification", methods="GET|POST")
     */
    public function ajouEtmodifClient(Client $client = null, Request $request, EntityManagerInterface $entityManager){

        if(!$client){
            $client = new Client();
        }
        $form = $this->createForm(ClientType::class,$client);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $modif = $client->getId() !==null;
            $entityManager->persist($client);
            $entityManager->flush();
            $this->addFlash("success",($modif)? "La modification du client n° {$client->getID()} a été effectué !":"L'ajout a été effectué");
            return $this->redirectToRoute("admin_client");
        }
        return $this->render("admin/client/modifEtAjoutClient.html.twig",[
            "client"=>$client,
            "form"=>$form->createView(),
            "isModification"=>$client->getId() !==null
        ]);
    }
        /**
         * @Route("/admin/client/{id}", name="admin_client_suppression", methods="delete")
         */
        public function supprClient(Client $client,Request $request, EntityManagerInterface $entityManager ){
            if($this->isCsrfTokenValid("SUP". $client->getId(),$request->get('_token'))){
                $entityManager->remove($client);
                $entityManager->flush();
                $this->addFlash("success", "La suppression a été effectué");
                return $this->redirectToRoute("admin_client");
            }
        }       
}
