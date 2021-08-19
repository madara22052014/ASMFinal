<?php

namespace App\DataFixtures;

use App\Entity\Publisher;
use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ObjectManager;

class PhoneFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $phone1 = new Phone();
        // $phone1->setPhoneName("Samsung Galaxy Z Fold3 5G");
        // // $phone1->setPublisher("Samsung");
        // $phone1->setOperatingSystem("Android 11");
        // $phone1->setMemory("256GB");
        // $phone1->setRAM("12GB");
        // $phone1->setDimension("158 x 128 x 6.4mm");
        // $phone1->setPrice(100);
        // $manager->persist($phone1);
        $manager->flush();
    }
}
