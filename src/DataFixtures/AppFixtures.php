<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
//use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setEmail("sender_".$i."@parcel.com");
            $user->setPassword(
                $this->userPasswordHasherInterface->hashPassword(
                    $user, "sender_".$i
                )
            );
            $user->setRoles(['ROLE_SENDER']);
            $manager->persist($user);
        }
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setEmail("bicker_".$i."@parcel.com");
            $user->setPassword(
                $this->userPasswordHasherInterface->hashPassword(
                    $user, "bicker_".$i
                )
            );
            $user->setRoles(['ROLE_BICKER']);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
