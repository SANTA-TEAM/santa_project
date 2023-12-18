<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Gift;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GiftFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $gift = (new Gift())
                ->setName($faker->text(50))
                ->setDescription($faker->text(200));
            $manager->persist($gift);
        }

        $manager->flush();
    }
}
