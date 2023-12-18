<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        $category = [
            "Peluches et Poupées",
            "Jeux de Construction",
            "Véhicules Radiocommandés",
            "Jeux de Société",
            "Jeux éducatifs et Scientifiques",
            "Figurines d'action",
            "Instruments de Musique pour Enfants",
            "Jeux de Plein Air",
            "Puzzle et Casse-tête",
            "Jeux Créatifs"
        ];

        foreach ($category as $name) {
            $category = (new Category())
                ->setName($name)
                ->setDescription($faker->text(200));
            $manager->persist($category);
        }

        $manager->flush();
    }
}
