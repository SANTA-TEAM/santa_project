<?php

namespace App\Tests\Unit;

use App\Entity\Age;
use App\Entity\Gift;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AgeTest extends KernelTestCase
{
    public function createAgeValid(): Age
    {
        return (new Age())
            ->setAge(18);
    }

    
    public function testEntityAge(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $age = $this->createAgeValid();

        $gift = (new Gift())
            ->setName('Test')
            ->setAge($age);

        $age->addGift($gift);

        $errors = $container->get('validator')->validate($age); 

        $this->assertCount(0, $errors);
        $this->assertSame($age, $gift->getAge());
    }
}
