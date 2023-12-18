<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $comment = (new Comment())
                ->setContent($faker->text(255))
                ->setUserName($faker->userName)
                ->setIsValid($faker->boolean);

            $manager->persist($comment);
        }

        $manager->flush();
    }
}
