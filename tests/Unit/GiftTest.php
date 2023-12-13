<?php

namespace App\Tests\Unit;

use App\Entity\Age;
use App\Entity\Gift;
use App\Entity\Image;
use App\Entity\Letter;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GiftTest extends KernelTestCase
{

    public function createGiftValid(User $user, Age $age): Gift
    {
        return (new Gift())
            ->setName('NameGiftTest')
            ->setDescription('DescriptionGiftTest')
            ->setAge($age)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setCreator($user);
    }

    public function testEntityGifts(): void
    {
        $kernel = self::bootKernel();

        $container = static::getContainer();

        $user = (new User())
            ->setEmail('test@gift.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword('password')
            ->setIsVerified(true)
            ->setFirstName('FirstNameTest')
            ->setLastName('LastNameTest')
            ->setAge(25);

        $age = (new Age())
            ->setAge(18);

        $gift = $this->createGiftValid($user, $age);

        $image = (new Image())
            ->setFileName('image_url_test')
            ->setGift($gift);

        $letter = (new Letter())
            ->setText('LetterContentTest')
            ->addGift($gift);

        $gift->addImage($image);
        $gift->addLetter($letter);

        $errors = $container->get('validator')->validate($gift);

        $this->assertCount(0, $errors);
        $this->assertSame('NameGiftTest', $gift->getName());
        $this->assertSame($user, $gift->getCreator());
        $this->assertSame($age, $gift->getAge());
    }
}
