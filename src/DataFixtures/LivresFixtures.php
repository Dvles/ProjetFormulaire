<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Livre;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LivresFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_BE");
        
        for ($i = 0; $i < 100; $i++){
            $livre = new Livre([

                'titre' => $faker->name(),
                'prix' => $faker->numberBetween(1, 999),
                'description' => $faker->text(),
                'date_publication' => $faker->dateTime(),
                'isbn' => $faker->isbn13(),

            ]);
        $manager->persist($livre);
        }

        $manager->flush();
    }
}


