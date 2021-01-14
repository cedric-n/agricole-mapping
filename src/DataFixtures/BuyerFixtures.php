<?php

namespace App\DataFixtures;

use App\Entity\Buyer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class BuyerFixtures extends Fixture implements ContainerAwareInterface, DependentFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $serializer = $this->container->get('serializer');
        $filepath = realpath ("./") . "/src/Resources/buyers.csv";

        $data = $serializer->decode(file_get_contents($filepath), 'csv');
        $i = 1;

        foreach ($data as $line) {
            $buyer = new Buyer();
            $buyer->setCity($this->getReference('city_'.$line['city_id']))
                ->setName($line['name'])
                ->setType($line['type']);
            $this->addReference('buyer_' . $i, $buyer);
            $manager->persist($buyer);
            $i++;
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CityFixtures::class];
    }
}