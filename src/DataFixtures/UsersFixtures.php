<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ( $i = 0; $i < 20; $i++ ) {
            $user = new User();
            $user
                ->setAge(rand(18, 80))
                ->setEmail('randomMail' . rand(1, 100000) . '@owl.owl')
                ->setHourlyRate(rand(1000, 25000) / 100)
                ->setName('randomName' . rand(1, 100000) )
                ->setPassword('randomPass' . rand(1, 100000))
                ->setPhoneNumber("+48565444321")
                ->setSurname('randomSurName' . rand(1, 100000));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
