<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Cheuns;
use Symfony\Component\Security\Core\User\User;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Cheuns();
        $user->setUsername('Guillaume');
        
        $user->setPassword($this->passwordEncoder->encodePassword(
             $user,
            'password'
        ));

        $userAdmin = new Cheuns();
        $userAdmin->setUsername('superAdmin');
        $userAdmin->setRoles(["ROLE_USER","ROLE_ADMIN"]);

        $userAdmin->setPassword($this->passwordEncoder->encodePassword(
            $userAdmin,
           'password'
       ));

        $manager->persist($user);
        $manager->persist($userAdmin);
        $manager->flush();
    }
}
