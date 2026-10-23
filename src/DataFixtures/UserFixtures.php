<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $comptes = [
            ['email' => 'admin@peche.fr', 'roles' => ['ROLE_ADMIN']],
            ['email' => 'jean@peche.fr', 'roles' => []],
            ['email' => 'marie@peche.fr', 'roles' => []],
            ['email' => 'paul@peche.fr', 'roles' => []],
        ];

        foreach ($comptes as $compte) {
            $user = new User();
            $user->setEmail($compte['email']);
            $user->setRoles($compte['roles']);

            // On hache le mot de passe AVANT de persister l'utilisateur
            $hash = $this->passwordHasher->hashPassword($user, 'peche123');
            $user->setPassword($hash);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
