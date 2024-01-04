<?php

namespace App\DataFixtures;

use App\Entity\Age;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AgeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ages= [3, 7, 12, 16, 18];

        foreach ($ages as $key => $age) {
            $age = (new Age())
                ->setAge($age);
        $this->addReference('age_' . $key, $age);
            $manager->persist($age);
        }

        $manager->flush();
    }
}
