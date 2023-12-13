<?php

namespace App\Tests\Unit;

use App\Entity\Address;
use App\Entity\City;
use App\Entity\Department;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CityTest extends KernelTestCase
{
    public function createCityValid(): City
    {
        $city = (new City())
            ->setName('NameCityTest')
            ->setZipCode('12345');
            
        $address = (new Address())
            ->setStreetName('streetNameTest')
            ->setStreetNumber('streetNumberTest')
            ->setCity($city);

        $city->addAddress($address);

        return $city;
    }


    public function testEntityCity(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $department = (new Department())
            ->setName('NameDepartmentTest')
            ->setCode('00000');

        $city = $this->createCityValid($department);

        $department->addCity($city);

        $errors = $container->get('validator')->validate($city);
        $this->assertCount(0, $errors);
        $this->assertSame($city, $department->getCities()->First());

    }
}
