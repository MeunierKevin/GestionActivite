<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBordController extends AbstractController
{
    /**
     * @Route("/admin", name="bord")
     */
    public function bord(): Response
    {
        return $this->render('admin/bord.html.twig');
    }
}
