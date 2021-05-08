<?php

namespace App\Controller\admin;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBordController extends AbstractController
{
    /**
     * @Route("/admin", name="bord")
     */
    public function bord(EntityManagerInterface $manager): Response
    {
        $clients = $manager->createQuery('SELECT COUNT(c) FROM App\Entity\Client c')->getSingleScalarResult();
        $projets = $manager->createQuery('SELECT COUNT(p) FROM App\Entity\Projet p')->getSingleScalarResult();

        $clientPerso = $manager->createQuery('SELECT COUNT(c) FROM App\Entity\Client c WHERE c.typeClient = 3')->getSingleScalarResult();
        $clientReseaux = $manager->createQuery('SELECT COUNT(c) FROM App\Entity\Client c WHERE c.typeClient = 2')->getSingleScalarResult();
        $clientPart = $manager->createQuery('SELECT COUNT(c) FROM App\Entity\Client c WHERE c.typeClient = 1')->getSingleScalarResult();

        return $this->render('admin/bord.html.twig',[
            'stats' => compact('clients','projets','clientPerso','clientReseaux','clientPart')
        ]);
    }
}
