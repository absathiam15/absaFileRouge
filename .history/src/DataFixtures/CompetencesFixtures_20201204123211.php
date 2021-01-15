<?php

namespace App\DataFixtures;

use App\Entity\Competences;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompetencesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 8; $i++) { 
            
            $grpComp = new Competences();

            $grpComp
            ->setLibelle("fghhgjhkjbnn")
            ->setDescription($faker->firstName);

            $grpComp->addGroupeCompetence($this->getReference($i));
            $manager->persist($grpComp);
            
        }

        $manager->flush();
    }
}
