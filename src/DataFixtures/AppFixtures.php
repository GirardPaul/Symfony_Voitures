<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

    $faker = \Faker\Factory::create('fr_FR');

    


       $marque1 = new Marque();
       $marque1->setLibelle("Yotota");
       $manager->persist($marque1);

       $marque2 = new Marque();
       $marque2->setLibelle("Jeupo");
       $manager->persist($marque2);

        $model1 = new Modele();
        $model1->setLibelle("Rayis")
                ->setImage("modele1.jpg")
                ->setPrixMoyen(15000)
                ->setMarque($marque1);

        $manager->persist($model1);


        $model2 = new Modele();
        $model2->setLibelle("Yraus")
                ->setImage("modele2.jpg")
                ->setPrixMoyen(20000)
                ->setMarque($marque1);

        $manager->persist($model2);


        $model3 = new Modele();
        $model3->setLibelle("007")
                ->setImage("modele3.jpg")
                ->setPrixMoyen(30000)
                ->setMarque($marque1);
        
        $manager->persist($model3);


        $model4 = new Modele();
        $model4->setLibelle("008")
                ->setImage("modele4.jpg")
                ->setPrixMoyen(10000)
                ->setMarque($marque1);

        $manager->persist($model4);

        $model5 = new Modele();
        $model5->setLibelle("009")
                ->setImage("modele5.jpg")
                ->setPrixMoyen(17000)
                ->setMarque($marque1);

        $manager->persist($model5);


        $model6 = new Modele();
        $model6->setLibelle("010")
                ->setImage("modele6.jpg")
                ->setPrixMoyen(25000)
                ->setMarque($marque1);

        $manager->persist($model6);

        $modeles = [$model1, $model2, $model3, $model4, $model5, $model6];
        foreach($modeles as $modele){
            $rand = rand(3,5);
            for($i=1; $i <= $rand; $i++){
                $voiture = new Voiture();
                //XX1234XX
                $voiture->setImmatriculation($faker->regexify("[A-Z]{2}[0-9]{3,4}[A-Z]{2}"))
                ->setNbPortes($faker->randomElement($array = array(3,5)))
                ->setAnnee($faker->numberBetween($min = 1990, $max = 2019))
                ->setModele($modele);
                $manager->persist($voiture);

            }
        }


        
        $manager->flush();
    }
}
