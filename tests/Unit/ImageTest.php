<?php

namespace App\Tests\Unit;

use App\Entity\Gift;
use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ImageTest extends KernelTestCase
{

    public function CreateImageValid(Gift $gift): Image
    {
        return (new Image())
            ->setFileName('image_file_test')
            ->setGift($gift);
    }

    public function testEntityImage(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $gift = (new Gift())
            ->setName('NameGiftTest')
            ->setDescription('DescriptionGiftTest')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());

        $image = $this->CreateImageValid($gift);

        $errors = $container->get('validator')->validate($image);
        $this->assertCount(0, $errors);
        $this->assertSame('image_file_test', $image->getFileName());
        $this->assertSame($gift, $image->getGift());

    }
}
