<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\GroupeCompetences;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\CompetencesFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GrpeCompetencesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 8; $i++) { 
            
            $grpComp = new GroupeCompetences();

            $grpComp
            ->setLibelle("fghhgjhkjbnn")
            ->setDescription($faker->firstName);
            // $this->addReference($i, $grpComp);
            $grpComp->setReferentiel($this->'referentiel'.$i);

            $grpComp->addCompetence($this->getReference('comp'.$i));
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


       
