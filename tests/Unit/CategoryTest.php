<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryTest extends KernelTestCase
{
    public function createCategoryValid(User $user): Category
    {
        return (new Category())
            ->setName('Nametest')
            ->setDescription('DescriptionTest')
            ->setCreator($user);
    }


    public function testEntityCategory(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $user = (new User())
            ->setEmail('test@entityCategory.fr')
            ->setRoles(['ROLE_USER'])
            ->setPassword('password')
            ->setIsVerified(true)
            ->setFirstName('firstNameTest')
            ->setLastName('lastNameTest')
            ->setAge(18);

        $category = $this->createCategoryValid($user);
        $user->addCategory($category);

        $errors = $container->get('validator')->validate($category);

        $this->assertCount(0, $errors);
        $this->assertSame($category, $user->getCategories()->First());

    }
}
