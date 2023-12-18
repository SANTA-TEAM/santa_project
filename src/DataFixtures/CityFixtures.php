<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CityFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
{
    for ($i = 0; $i < 250; ++$i) {
        $city = (new City())
            ->setName('Rue ' . $i)
            ->setZipCode($this->generateRandomZipCode());

        $department = $this->getReference('department_' . rand(1, 101));
        $city->setDepartment($department);

        $reference = 'city_' . $i;
        $this->addReference($reference, $city);

        $manager->persist($city);
    }

    $manager->flush();
}

    private function generateRandomZipCode(): string
    {
        return str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    }

    public function getDependencies(): array
    {
        return [
            DepartmentFixtures::class,
        ];
    }
}
