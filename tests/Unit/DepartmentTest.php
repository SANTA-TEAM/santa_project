<?php

namespace App\Tests\Unit;

use App\Entity\City;
use App\Entity\Department;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DepartmentTest extends KernelTestCase
{
    public function createDepartmentValid(): Department
    {
        return (new Department())
            ->setName('NameDepartmentTest')
            ->setCode('00000');
    }

    public function testEntityDepartment(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $department = $this->createDepartmentValid();

        $city = (new City())
            ->setName('CityTest')
            ->setZipCode('12345')
            ->setDepartment($department);

        $department->addCity($city);

        $errors = $container->get('validator')->validate($department);

        $this->assertCount(0, $errors);
        $this->assertSame('NameDepartmentTest', $department->getName());
        $this->assertSame('00000', $department->getCode());

        $this->assertSame($department, $city->getDepartment());

    }
}
