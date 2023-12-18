<?php

namespace App\DataFixtures;

use App\Entity\Reindeers;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ReindeersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $namesReindeers = [
            'Tornade',
            'Danseur',
            'Fringant',
            'Furie',
            'Comète',
            'Cupidon',
            'Tonerre',
            'Eclair',
            'Rudolph',
        ];

        foreach ($namesReindeers as $name) {
            $reindeer = new Reindeers();
            $reindeer->setName($name);
            $reindeer->setStory($faker->text(255));
            $reindeer->setFileName($faker->image('public/uploads/reindeers/', 640, 480, null, false));
            $manager->persist($reindeer);
        }

        $manager->flush();
    }
}
