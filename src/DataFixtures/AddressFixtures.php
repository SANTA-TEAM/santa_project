<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AddressFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $address = (new Address())
                ->setStreetName('Street ' . $i)
                ->setStreetNumber($i);

            $cityReference = 'city_' . rand(0, 999);
            
            if ($this->hasReference($cityReference)) {
                $city = $this->getReference($cityReference);
                $address->setCity($city);
            }

            $this->addReference('address_' . $i, $address);

            $manager->persist($address);
            
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CityFixtures::class,

        ];
    }
}
