<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Competences;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompetencesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 8; $i++) { 
            
            $compet = new Competences();

            $compet
            ->setLibelle("fghhgjhkjbnn")
            ->setDescription($faker->firstName)

            ->addGroupeCompetence($this->getReference($i))
            ->addReferentiel($this->getReference($i));
            $manager->persist($compet);
            
        }

        $manager->flush();
    }
}
