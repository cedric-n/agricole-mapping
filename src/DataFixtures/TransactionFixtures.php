<?php

namespace App\DataFixtures;

use App\Entity\Transaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TransactionFixtures extends Fixture implements ContainerAwareInterface, DependentFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $serializer = $this->container->get('serializer');
        $filepath = realpath("./") . "/src/Resources/transactions.csv";

        $data = $serializer->decode(file_get_contents($filepath), 'csv');

        for ($i=0; $i < count($data); $i++) {
            $line = $data[$i];
            $transaction = new Transaction();
            $transaction->setPrice($line['price']);
            $transaction->setQuantity($line['quantity']);

            $dates = explode("/", $line['created_at']);
            $createdAt = new \DateTime();
            $createdAt->setDate($dates[2], $dates[0], $dates[1]);
            $transaction->setCreateAt($createdAt);

            $transaction->setProduct($this->getReference('product_' . $line['product_id']));
            $transaction->setFarmer($this->getReference('farmer_' . $line['farmer_id']));
            $transaction->setBuyer($this->getReference('buyer_' . $line['buyer_id']));

            $this->addReference('transaction_' . ($i+1), $transaction);
            $manager->persist($transaction);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProductFixtures::class, FarmerFixtures::class, BuyerFixtures::class];
    }
}