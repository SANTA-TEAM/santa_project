<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasherInterface
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = (new User())
            ->setEmail('santaclaus@christmas.fr')
            ->setRoles(['ROLE_ADMIN', 'ROLE_DWARF'])
            ->setIsVerified(true)
            ->setFirstName('Santa')
            ->setLastName('Claus');
        $admin->setPassword($this->userPasswordHasherInterface->hashPassword($admin, 'christmas'));

        $manager->persist($admin);

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 5; ++$i) {
            $nain = (new User())
                ->setEmail($faker->unique()->email)
                ->setRoles(['ROLE_DWARF'])
                ->setIsVerified(true)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName);
            $nain->setPassword($this->userPasswordHasherInterface->hashPassword($nain, 'password'));

            $manager->persist($nain);
        }

        for ($i = 0; $i < 20; ++$i) {
            $user = (new User())
                ->setEmail($faker->unique()->email)
                ->setRoles(['ROLE_USER'])
                ->setIsVerified(true)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName);
            $user->setPassword($this->userPasswordHasherInterface->hashPassword($user, 'password'));

            $address = $this->getReference('address_' . rand(0, 19));
            $user->setAddress($address);
            $this->addReference('user_' . $i, $user);


            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AddressFixtures::class,
        ];
    }
}
