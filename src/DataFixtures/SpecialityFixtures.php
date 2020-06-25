<?php

namespace App\DataFixtures;

use App\Entity\Speciality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpecialityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $speciality = [
            'Médecine générale',
            'Chirurgie Dentaire',
            'Radiologie',
            'Anesthésie',
            'Ophtalmologie',
            'Gynécologie obstréticienne',
            'Sage-femme',
            'Chirurgie orthopédique et traumatologie',
            'Cardiologie',
            'Oto-Rhino-Laryngologie (ORL)',
            'Chirurgie cervico-faciale',
            'Dermatologie',
            'Vénérologie',
            'Gastro-entérologie',
            'Hépatologie',
            'Chirurgie urologie',
            'Rhumatologie',
            'Chirurgie générale',
            'Pédiatrie',
            'Stomatologie',
            'Pneumologie',
            'Chirurgie viscérale',
            'Chirurgie plasticienne',
            'Gynécolgie médicale',
            'Chirurgie maxillo-faciale',
            'Psychiatrie',
            'Neurologie',
            'Chirurgie vasculaire',
            'Médecine nucléaire',
            'Gynécologie médicale',
            'Obstrétie',
            'Endocrinologie-diabétologie',
            'Chirurgie Thoracique et cardio-vasculaire',
            'Médecine physique et de réadaptation',
            'Neurochirurgie',
            'Néphrologie',
            'Chirurgie-dentiste spécialiste en chirurgie orale',
            'Chirurgie maxillo - faciale',
            'Chirurgie - dentiste spécialiste en orthopédie dento - faciale',
            'Spécialiste en médecine interne',
            'Chirurgie infantile',
            'Cancérologie médicale',
            'Gériatrie',
            'Chirurgie - dentistes spécialiste en médecine bucco - dentaire',
            'Hématologie',
            'Obstétrie',
            'Neuropsychiatrie',
            'Psychiatrie de l\'enfant et de l\'adolescent',
            'Anatomo-Cyto-Pathologie',
            'Cancérologie radiothérapie',
            'Médecin généticien',
            'Chirurgie orale',
            'Radiothérapie',
            'Réanimation médicale',
            'Médecine biologique',
            'Médecine spécialisée en santé publique et médecine sociale',
        ];

        $i = 1;
        foreach ($speciality as $item){
            $s = new Speciality();
            $s->setCategory($item);
            $this->addReference('speciality_'.$i, $s);
            $manager->persist($s);
            $i++;
        }
        $manager->flush();
    }
}
