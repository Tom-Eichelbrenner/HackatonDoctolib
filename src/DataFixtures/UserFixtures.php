<?php

namespace App\DataFixtures;

use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhpParser\Comment\Doc;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

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
            $this->addReference('patient_'.$i, $patient);
            $manager->persist($patient);
        }

        for ($i=1;$i<=30;$i++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setRoles(['ROLE_DOCTOR']);
            $user->setPassword('password');
            $manager->persist($user);

            $doctor = new Doctor();
            $doctor->setRegion($faker->city);
            $doctor->setLName($faker->lastName);
            $doctor->setFName($faker->firstName);
            $doctor->setUser($user);
            $doctor->setPhone($faker->phoneNumber);
            $doctor->setSpeciality($this->getReference('speciality_'.rand(1,50)));
            $this->addReference('doctor_'.$i, $doctor);
            $manager->persist($doctor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [SpecialityFixtures::class];
    }
}
