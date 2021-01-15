<?php

namespace App\DataFixtures;

use App\Entity\GroupeCompetences;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GrpeCompetencesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 8; $i++) { 
            
            $grpComp = new GroupeCompetences();

            $grpComp
            ->setLibelle("fghhgjhkjbnn")
            ->setDescription($faker->firstName);

            $grpComp->addCompetence($this->getReference($i));
            $manager->persist($grpComp);
            
        }
        $manager->flush();
           
    }

    public function getDependencies()
    {
        return array(
            CompetencesFixtures::class,
        );
    }
    
    
}


       
