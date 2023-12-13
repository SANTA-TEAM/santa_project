<?php

namespace App\Tests\Unit;

use App\Entity\Comment;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentTest extends KernelTestCase
{
    public function createCommentValid(User $user): Comment
    {
        return (new Comment())
            ->setContent('ContentCommentTest')
            ->setUserName('UserNameTest')
            ->setIsValid(true)
            ->setValidator($user);
    }

    public function testEntityComment(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $user = (new User())
            ->setEmail('test@comment.fr')
            ->setRoles(['ROLE_USER'])
            ->setPassword('password')
            ->setIsVerified(true)
            ->setFirstName('firstNameTest')
            ->setLastName('lastNameTest')
            ->setAge(25);

        $comment = $this->createCommentValid($user);
        $comment->setIsValid(true);

        $errors = $container->get('validator')->validate($comment);
        $this->assertCount(0, $errors);
    }
}
