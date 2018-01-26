<?php

namespace App\DataFixtures\ORM;

use App\Entity\Locker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLockerData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $locker1 = new Locker('L01');

        $locker2 = new Locker('L02');
        $locker2->depositPackage('SecretCode');

        $locker3 = new Locker('L03');
        $locker3->depositPackage('OtherCode');

        $locker4 = new Locker('L04', Locker::STATUS_OUT_OF_ORDER);

        $manager->persist($locker1);
        $manager->persist($locker2);
        $manager->persist($locker3);
        $manager->persist($locker4);
        $manager->flush();
    }
}
