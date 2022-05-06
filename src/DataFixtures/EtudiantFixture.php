<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create('fr_FR');
        for($i=0;$i<10;$i++){
            $etudiant=new Etudiant();
            $etudiant->setFirstname($faker->firstName);
            $etudiant->setName($faker->name);
            $manager->persist($etudiant);

        }
        for($j=1;$j<10;$j++){
            $etudiant=new Etudiant();
            $etudiant->setFirstname($faker->firstName);
            $etudiant->setName($faker->name);
            $sections=$manager->getRepository(Section::class)->findAll();
            $x=rand(1,count($sections)-1);
            $etudiant->setSection($sections[$x]);
            $manager->persist($etudiant);

        }
        $manager->flush();
    }
}
