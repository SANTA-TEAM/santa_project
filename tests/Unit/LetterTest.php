<?php

namespace App\Tests\Unit;

use App\Entity\Gift;
use App\Entity\Letter;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LetterTest extends KernelTestCase
{
    public function createLetterValid(User $user): Letter
    {
        return (new Letter())
            ->setTitle('TitleLetterTest')
            ->setText('TextLetterTest')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setWriter($user);
    }

    public function testEntityLetter(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $user = (new User())
            ->setEmail('test@letter.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword('password')
            ->setIsVerified(true)
            ->setFirstName('FirstNameTest')
            ->setLastName('LastNameTest')
            ->setAge(25);

        $letter = $this->createLetterValid($user);

        $gift = (new Gift())
            ->setName('NameGiftTest')
            ->setDescription('DescriptionGiftTest')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());

        $letter->addGift($gift);

        $errors = $container->get('validator')->validate($letter);

        $this->assertCount(0, $errors);
        $this->assertSame('TitleLetterTest', $letter->getTitle());
        $this->assertSame('TextLetterTest', $letter->getText());
        $this->assertSame($user, $letter->getWriter());
        $this->assertSame($gift, $letter->getGift()->first());
    }
}
