<?php

namespace App\DataFixtures;

use App\Entity\Test;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TestFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<100;$i++){
            $faker=Factory::create('fr_FR');
            $test=new Test();
            $test->setDesignation($faker->address);
            $manager->persist($test);
        }
        $manager->flush();
    }
}
