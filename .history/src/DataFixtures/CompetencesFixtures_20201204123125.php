<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompetencesFixtures extends Fixture
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
}
