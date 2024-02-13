<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Repository\CityRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AddressFixtures extends Fixture
{
    private $cityRepository;
    private $cities = [];

    public function __construct(
        CityRepository $cityRepository,
        array $cities = []
        )
    {
        $this->cityRepository = $cityRepository;
        $this->cities = $cityRepository->findAll();
    }
    public function load(ObjectManager $manager): void
    {

        $cities = $this->cityRepository->findAll();

        for ($i = 0; $i < 20; $i++) {
            $address = (new Address())
                ->setStreetName('Street ' . $i)
                ->setStreetNumber($i);
                // ->setCity($this->cities[(array_rand($this->cities))]);

            $this->addReference('address_' . $i, $address);

            $manager->persist($address);
        }
        $manager->flush();
    }
}
