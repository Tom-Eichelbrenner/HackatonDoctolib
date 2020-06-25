<?php


namespace App\DataFixtures;


use App\Entity\Region;
use App\Entity\Speciality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class RegionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $departments = [];
        $i=0;
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'https://geo.api.gouv.fr/departements');
        $content = $response->toArray();
        foreach ($content as $key => $value)
        {
            $departments[$i]["zipCode"] = (int)$value["code"];
            $departments[$i]["name"] = $value["nom"];
            $i++;
        }
        $i = 1;
        foreach ($departments as $department){
            $region = new Region();
            $region->setZipCode($department["zipCode"]);
            $region->setName($department["name"]);
            $this->addReference(Region::class.'_'.$i, $region);
            $manager->persist($region);
            $i++;
        }
        $manager->flush();
    }
}