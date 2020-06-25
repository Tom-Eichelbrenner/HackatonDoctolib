<?php

namespace App\DataFixtures;

use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\Region;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=1;$i<=300;$i++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setRoles(['ROLE_PATIENT']);
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));
            $manager->persist($user);
            $patient = new Patient();
            $patient->setUser($user);
            $patient->setBdate($faker->dateTime);
            $patient->setDisease($faker->text);
            $patient->setFName($faker->firstName);
            $patient->setLName($faker->lastName);
            $patient->setRegion($this->getReference(Region::class."_".rand(1, 101)));
            $sex = ['homme','femme'];
            $patient->setSex($sex[rand(0,1)]);
            $this->addReference('patient_'.$i, $patient);
            $manager->persist($patient);
        }

        for ($i=1;$i<=500;$i++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setRoles(['ROLE_DOCTOR']);
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));
            $manager->persist($user);

            $doctor = new Doctor();
            $doctor->setRegion($this->getReference(Region::class."_".rand(1, 101)));
            $doctor->setLName($faker->lastName);
            $doctor->setFName($faker->firstName);
            $doctor->setUser($user);
            $doctor->setPhone($faker->phoneNumber);
            $doctor->setSpeciality($this->getReference('speciality_'.rand(1, 50)));
            $this->addReference('doctor_'.$i, $doctor);
            $manager->persist($doctor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SpecialityFixtures::class,
            RegionFixtures::class,
        ];
    }
}
