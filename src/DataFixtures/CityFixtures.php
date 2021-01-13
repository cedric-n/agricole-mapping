<?php

namespace App\DataFixtures;


use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class CityFixtures extends Fixture implements ContainerAwareInterface

{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $serializer = $this->container->get('serializer');
        $filepath = realpath("./") . "/src/Resources/cities.csv";

        $data = $serializer->decode(file_get_contents($filepath), 'csv');

        for ($i = 0; $i < count($data); $i++) {
            $line = $data[$i];
            $city = new City();
            $city->setZipcode($line['zipcode']);
            $city->setCity($line['city']);
            $city->setLat($line['lat']);
            $city->setLon($line['long']);
            $city->setInseeCode($line['insee_code']);
            $this->addReference('city' . ($i + 1), $city);
            $manager->persist($city);
        }
        $manager->flush();
    }
}