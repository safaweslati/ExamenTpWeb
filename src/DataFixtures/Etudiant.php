<?php

namespace App\DataFixtures;

use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Etudiant extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create('fr_FR');
        for($i=1;$i<=10;$i++) {
            $section = new Section();
            $section->setDesignation("Section $i");
            $manager->persist($section);
            $etudiant = new \App\Entity\Etudiant();
            $etudiant->setName($faker->name);
            $etudiant->setFirstname($faker->firstName);
            $etudiant->setSection($section);
            $manager->persist($etudiant);
        }
        for($j=0;$j<10;$j++){
            $etudiant=new \App\Entity\Etudiant();
            $etudiant->setFirstname($faker->firstName);
            $etudiant->setName($faker->name);
            $manager->persist($etudiant);
        }
        $manager->flush();
    }
}
