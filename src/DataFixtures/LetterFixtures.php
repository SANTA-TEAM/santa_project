<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Letter;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LetterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; ++$i) {
            $letter = (new Letter())
                ->setTitle($faker->sentence(3))
                ->setText($faker->text(200))
                ->setWriter($this->getReference('user_' . rand(0, 2)));

            $manager->persist($letter);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
