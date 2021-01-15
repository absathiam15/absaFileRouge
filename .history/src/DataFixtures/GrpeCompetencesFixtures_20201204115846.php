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

        for ($i=0; $i < 5; $i++) { 
            
            $grpComp = new GroupeCompetences();

            $grpComp
            ->setLibelle('name'.uniqid())
            ->setDescription($faker->firstName);
            ->setAdresse($faker->address)
            ->setGenre($faker->randomElement(['homme', 'femme']))
            ->setGenre($faker->randomElement(['homme', 'femme']))
            ->setTelephone(770912122);

            $grpComp->addGroupe($this->getReference($i));
            $grpComp->persist($grpComp);
            
        }
        $manager->flush();
           
    }

    public function getDependencies()
    {
        return array(
            GroupeFixtures::class,
        );
    }
}

        $manager->flush();
    }
}
