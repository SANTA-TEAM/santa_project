<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Gift;
use App\DataFixtures\AgeFixtures;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class GiftFixtures extends Fixture
{
    public function __construct (private SluggerInterface $slugger)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $gift = (new Gift())
                ->setName($faker->text(50))
                ->setDescription($faker->text(200))
                ->setCategory($this->getReference('category_' . rand(0, 9)))
                ->setAge($this->getReference('age_' . rand(0, 4)));
            $gift->setSlug($this->slugger->slug($gift->getName())->lower());

            $manager->persist($gift);
        }

        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            AgeFixtures::class
        ];
    }
}
