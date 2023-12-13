<?php

namespace App\Tests\Unit;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MessageTest extends KernelTestCase
{
    public function createMessageValid(User $user): Message
    {
        return (new Message())
            ->setTitle('TitleMessageTest')
            ->setContent('ContentMessageTest')
            ->setWriter($user);
    }

    public function testEntityMessage(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $user = (new User())
            ->setEmail('test@message.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword('password')
            ->setIsVerified(true)
            ->setFirstName('FirstNameTest')
            ->setLastName('LastNameTest')
            ->setAge(25);

        $message = $this->createMessageValid($user);

        $errors = $container->get('validator')->validate($message);

        $this->assertCount(0, $errors);
        $this->assertSame('TitleMessageTest', $message->getTitle());
        $this->assertSame('ContentMessageTest', $message->getContent());
        $this->assertSame($user, $message->getWriter());
    }
}
