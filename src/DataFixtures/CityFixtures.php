<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use App\Entity\City;

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
        $filepath = realpath ("./") . "/src/Resources/cities.csv";

        $data = $serializer->decode(file_get_contents($filepath), 'csv');
        $i = 1;

        foreach ($data as $line) {
            $city = new City();
            $city->setZipcode($line['zipcode'])
                ->setCity($line['city'])
                ->setLat($line['lat'])
                ->setLon($line['long'])
                ->setInseeCode($line['insee_code']);
            $this->addReference('city_' . $i, $city);
            $manager->persist($city);
            $i++;
        }

        $manager->flush();
    }
}