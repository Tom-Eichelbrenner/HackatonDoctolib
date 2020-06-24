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
            'Chirurgien-Dentiste',
            'Radiologue',
            'Médecin généraliste',
            'Anesthésiste réanimateur',
            'Ophtalmologiste',
            'Gynécologue obstréticien',
            'Sage-femme',
            'Chirurgien orthopédiste et traumatologue',
            'Cardiologue',
            'Oto-Rhino-Laryngologue (ORL)',
            'Chirurgien cervico-facial',
            'Dermatologue',
            'Vénérologue',
            'Gastro-entérologue',
            'Hépatologue',
            'Chirurgien urologue',
            'Rhumatologue',
            'Chirurgien général',
            'Pédiatre',
            'Stomatologist',
            'Pneumologue',
            'Chirurgien viscéral',
            'Chirurgien plasticien',
            'Gynécolgue médical',
            'Chirurgien maxillo-facial',
            'Psychiatre',
            'Neurologue',
            'Chirurgien vasculaire',
            'Médecine nucléaire',
            'Gynécologue médical',
            'Obstréticien',
            'Endocrinologue-diabétologue',
            'Chirurgien Thoracique et cardio-vasculaire',
            'Spécialiste en médecine physique et de réadaptation',
            'Neurochirurgien',
            'Néphrologue',
            'Chirurgiens-dentistes spécialiste en chirurgie orale',
            'Chirurgien maxillo - facial',
            'Chirurgien - dentiste spécialiste en orthopédie dento - faciale',
            'Spécialiste en médecine interne',
            'Chirurgien infantile',
            'Cancérologue médical',
            'Gériatre',
            'Chirurgiens - dentistes spécialiste en médecine bucco - dentaire',
            'Hématologue',
            'Obstétricien',
            'Neuropsychiatre',
            'Psychiatre de l\'enfant et de l\'adolescent',
            'Anatomo-Cyto-Pathologiste',
            'Cancérologue radiothérapeute',
            'Médecin généticien',
            'Chirurgien oral',
            'Radiothérapeute',
            'Réanimateur médical',
            'Médecin biologiste',
            'Médecin spécialiste en santé publique et médecine sociale',
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
