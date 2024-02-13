<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; ++$i) {
            $message = (new Message())
            ->setTitle($faker->sentence(6))
            ->setContent($faker->paragraph(2))
            ->setWriter($this->getReference('user_' . rand(0, 2)));
            $manager->persist($message);
        }
        
        $manager->persist($message);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
