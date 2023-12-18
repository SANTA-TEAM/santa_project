<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MessageFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; ++$i) {
            $message = (new Message())
            ->setTitle($faker->sentence(6))
            ->setContent($faker->paragraph(2));
            $manager->persist($message);
        }
        

        $manager->persist($message);

        $manager->flush();
    }
}
