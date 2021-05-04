<?php

namespace App\Controller\admin;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
