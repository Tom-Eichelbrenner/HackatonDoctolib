<?php

namespace App\DataFixtures;

use App\Entity\AdviceRequest;
use App\Entity\Messages;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AdviceRequestFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $advice = new AdviceRequest();
        $advice->setIsViewed(true);
        $rand = rand(1, 50);
        $advice->setPathology($this->getReference('speciality_'.$rand));
        $advice->setPatient($this->getReference('patient_25'));
        $advice->setProblem($faker->text);
        $advice->setTopic($faker->word);
        $manager->persist($advice);
        $advice->setDdoctor($this->getReference('doctor_25'));
        for ($o=1;$o<=20;$o++){
            $message = new Messages();
            $date = new DateTime();
            $message->setDate($date);
            $message->setMessage($faker->text);
            $message->setAdviceRequest($advice);
            if($o%2==0) {
                $message->setDoctor($this->getReference('doctor_25'));
            }else{
                $message->setPatient($this->getReference('patient_25'));
            }
            $manager->persist($message);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [SpecialityFixtures::class, UserFixtures::class];
    }
}
