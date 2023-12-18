<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DepartmentFixtures extends Fixture 
{
    private $counter = 1;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 101; ++$i) {
            $department = (new Department())
                ->setName($faker->unique()->departmentName)
                ->setCode($faker->unique()->departmentNumber)
            ;
            $this->addReference('department_' . $this->counter, $department);
            $this->counter++;

            $manager->persist($department);

        }

        $manager->flush();
    }


}
