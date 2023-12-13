<?php

namespace App\Tests\Unit;

use App\Entity\Address;
use App\Entity\City;
use App\Entity\User;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AddressTest extends KernelTestCase
{
    public function createValidAddress(): Address
    {
        return (new Address())
            ->setStreetName('Example Street')
            ->setStreetNumber('123')
            ->setCity(new City());
    }

    public function testEntityAddress(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $address = $this->createValidAddress();

        $user = (new User())
            ->setFirstName('John')
            ->setLastName('Doe');

        $address->addChild($user);

        $errors = $container->get('validator')->validate($address); 

        $this->assertCount(0, $errors);
        $this->assertSame($address, $user->getAddress());
    }
}

