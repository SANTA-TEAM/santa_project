<?php

namespace App\Tests\Unit;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function createUserValid(): User
    {
        return (new User())
            ->setEmail('test@example.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword('password')
            ->setIsVerified(true)
            ->setFirstName('FirstNameTest')
            ->setLastName('LastNameTest')
            ->setAge(25)
            ->setCeatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());
    }

    public function testEntityUser(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $user = $this->createUserValid();

        $errors = $container->get('validator')->validate($user);

        $this->assertCount(0, $errors);
        $this->assertSame('test@example.com', $user->getEmail());
        $this->assertSame(['ROLE_USER'], $user->getRoles());
        $this->assertSame('password', $user->getPassword());
        $this->assertTrue($user->isVerified());
        $this->assertSame('FirstNameTest', $user->getFirstName());
        $this->assertSame('LastNameTest', $user->getLastName());
        $this->assertSame(25, $user->getAge());
        $this->assertInstanceOf(\DateTimeImmutable::class, $user->getCeatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $user->getUpdatedAt());
    }
}
