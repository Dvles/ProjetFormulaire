<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $faker = Factory::create("fr_BE");

        for ($i =0; $i < 30; $i++){

            $auteur = new Auteur();
            $auteur->setNom($faker->name());
            $auteur->setNationalite($faker->country());
            $manager->persist($auteur);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
