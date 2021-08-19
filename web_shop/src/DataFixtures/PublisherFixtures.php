<?php

namespace App\DataFixtures;

use App\Entity\Publisher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PublisherFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $publisher1 = new Publisher();
        $publisher1->setCompanyName("Samsung Group");
        $publisher1->setCountry("Korean");
        $publisher1->setFounded(1938);
        $manager->persist($publisher1);

        $publisher2 = new Publisher();
        $publisher2->setCompanyName("Apple Inc.");
        $publisher2->setCountry("American");
        $publisher2->setFounded(1971);
        $manager->persist($publisher2);

        $publisher3 = new Publisher();
        $publisher3->setCompanyName("Xiaomi Corporation");
        $publisher3->setCountry("Chinese");
        $publisher3->setFounded(2010);
        $manager->persist($publisher3);

        $publisher4 = new Publisher();
        $publisher4->setCompanyName("OPPO");
        $publisher4->setCountry("Chinese");
        $publisher4->setFounded(2004);
        $manager->persist($publisher4);

        $publisher5 = new Publisher();
        $publisher5->setCompanyName("LG Corporation");
        $publisher5->setCountry("Korean");
        $publisher5->setFounded(1958);
        $manager->persist($publisher5);

        $publisher6 = new Publisher();
        $publisher6->setCompanyName("Vsmart");
        $publisher6->setCountry("Viet Nam");
        $publisher6->setFounded(2018);
        $manager->persist($publisher6);

        $publisher7 = new Publisher();
        $publisher7->setCompanyName("Sony");
        $publisher7->setCountry("Japan");
        $publisher7->setFounded(1946);
        $manager->persist($publisher7);

        $publisher8 = new Publisher();
        $publisher8->setCompanyName("Nokia Corporation");
        $publisher8->setCountry("Finland");
        $publisher8->setFounded(1865);
        $manager->persist($publisher8);

        $publisher9 = new Publisher();
        $publisher9->setCompanyName("Microsoft");
        $publisher9->setCountry("American");
        $publisher9->setFounded(1975);
        $manager->persist($publisher9);

        $publisher10 = new Publisher();
        $publisher10->setCompanyName("ASUSTek");
        $publisher10->setCountry("Taiwan");
        $publisher10->setFounded(1989);
        $manager->persist($publisher10);

        $manager->flush();
    }
}
