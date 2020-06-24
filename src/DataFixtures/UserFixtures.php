<?php

namespace App\DataFixtures;

use App\Entity\Patient;
use App\Entity\User;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i=1;$i<=30;$i++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setRoles(['ROLE_PATIENT']);
            $user->setPassword('password');
            $manager->persist($user);
            $patient = new Patient();
            $patient->setUser($user);
            $patient->setBdate($faker->dateTime);
            $patient->setDisease($faker->text);
            $patient->setFName($faker->firstName);
            $patient->setLName($faker->lastName);
            $patient->setRegion($faker->city);
            $manager->persist($patient);
        }

        $manager->flush();
    }
}
