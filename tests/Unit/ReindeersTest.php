<?php

namespace App\Tests\Unit;

use App\Entity\Reindeers;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ReindeersTest extends KernelTestCase
{
    public function createReindeersValid(): Reindeers
    {
        return (new Reindeers())
            ->setName('NameReindeersTest')
            ->setCeatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setStory('StoryReindeersTest')
            ->setFileName('file_name_test.jpg');
    }

    public function testEntityReindeers(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $reindeers = $this->createReindeersValid();

        $errors = $container->get('validator')->validate($reindeers);

        $this->assertCount(0, $errors);
        $this->assertSame('NameReindeersTest', $reindeers->getName());
        $this->assertInstanceOf(\DateTimeImmutable::class, $reindeers->getCeatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $reindeers->getUpdatedAt());
        $this->assertSame('StoryReindeersTest', $reindeers->getStory());
        $this->assertSame('file_name_test.jpg', $reindeers->getFileName());
    }
}
