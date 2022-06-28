<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder){ }
    public function load(ObjectManager $manager): void
    {
         $admin = new User();
         $admin->setEmail('admin@google.com');
         $admin->setRoles(['ROLE_ADMIN']);
         $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin,'admin123@')
         );
         $admin->setGender(false);
         $admin->setLastname('Capard');
         $admin->setFirstname('William');
         $admin->setAddress('30 rue des arènes');
         $admin->setPostcode('30000');
         $admin->setCity('Nîmes');
         $admin->setDateBirth(\DateTime::createFromFormat("d/m/Y", "13/06/1982"));

        $user1 = new User();
        $user1->setEmail('user@google.com');
        $user1->setRoles([""]);
        $user1->setPassword(
            $this->passwordEncoder->hashPassword($user1,'user123@')
        );
        $user1->setGender(false);
        $user1->setLastname('Pesquet');
        $user1->setFirstname('Thomas');
        $user1->setAddress('1 rue de la Terre');
        $user1->setPostcode('30000');
        $user1->setCity('Nîmes');
        $user1->setDateBirth(\DateTime::createFromFormat("d/m/Y", "27/02/1978"));

        $manager->persist($admin);
        $manager->persist($user1);

        $manager->flush();
    }
}
