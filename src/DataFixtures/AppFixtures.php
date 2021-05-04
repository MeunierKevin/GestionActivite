<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Image;
use App\Entity\Client;
use App\Entity\Projet;
use App\Entity\TypeImage;
use App\Entity\TypeProjet;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        //CREATION DE TYPES D'IMAGE
        $typeImage1 = new TypeImage();
        $typeImage1->setLibelle('Maquettage');
        $manager->persist($typeImage1);

        $typeImage2 = new TypeImage();
        $typeImage2->setLibelle('CharteGraphique');
        $manager->persist($typeImage2);

        $types = [$typeImage1,$typeImage2];

        //CREATION DE TYPES DE DE PROJETS
        $typeProjet1 = new TypeProjet();
        $typeProjet1->setLibelle("Nouveau Site");
        $manager->persist($typeProjet1);

        $typeProjet2 = new TypeProjet();
        $typeProjet2->setLibelle("Refonte");
        $manager->persist($typeProjet2);

        $typesProjet = [$typeProjet1,$typeProjet2];

        //CREATION DE CLIENTS
        $faker = Factory::create('fr_FR');

        for($i=1;$i<=15;$i++){
            $client = new Client();

            $nomEntreprise = $faker->company();
            $prenom = $faker->firstName();
            $nom = $faker->lastName();
            $adresse = $faker->address();
            $telephone = $faker->phoneNumber();
            $email = $faker->email();
            $presentation = $faker->text(2000);

            $client->setNomEntreprise($nomEntreprise)
                    ->setPrenomContact($prenom)
                    ->setNomContact($nom)
                    ->setAdresse($adresse)
                    ->setTelephone($telephone)
                    ->setEmail($email)
                    ->setPresentationEntreprise($presentation);

            $manager->persist($client);

        //CREATION DE PROJETS 

            $projet = new Projet();

            $fakeData = $faker->text(2000);
            $dateMaquette = $faker->dateTimeThisYear();
            $interval = rand(3,25);
            $dateDeveloppement = (clone $dateMaquette)->modify("+$interval days");
            $dateTests = (clone $dateDeveloppement)->modify("+$interval days");
            $dateMiseEnLigne = (clone $dateTests)->modify("+$interval days");
            $typeProjet = $typesProjet[mt_rand(0,count($typesProjet)-1)];

            $projet->setAnalyseExistant($fakeData)
                    ->setObjectifsDuSite($fakeData)
                    ->setCibles($fakeData)
                    ->setFonctionnalites($fakeData)
                    ->setCharteGraphique($fakeData)
                    ->setContenuDuSite($fakeData)
                    ->setMaquettage($fakeData)
                    ->setContraintesTechniques($fakeData)
                    ->setPrestationsDevis($fakeData)
                    ->setDateMaquette($dateMaquette)
                    ->setDateDeveloppement($dateDeveloppement)
                    ->setDateTests($dateTests)
                    ->setDateMiseEnLigne($dateMiseEnLigne)
                    ->setClient($client)
                    ->setTypeProjet($typeProjet);
            
            $manager->persist($projet);

            //CREATION D'IMAGES
            for($j = 1;$j<=mt_rand(2,5);$j++){
                $image = new Image();

                $type = $types[mt_rand(0,count($types)-1)];
                $imageUrl = 'https://picsum.photos/800/600';

                $image->setProjet($projet)
                        ->setTypeImage($type)
                        ->setUrlImage($imageUrl);

                $manager->persist($image);
            }
            
        }
        $manager->flush();
    }
}
