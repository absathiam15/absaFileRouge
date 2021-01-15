<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GrpeCompetencesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 5; $i++) { 
            
            $apprenant = new Apprenant;

            $apprenant->setUsername('name'.uniqid());
            $apprenant->setPassword($this->encoder->EncodePassword($apprenant, 'password'));
            $apprenant->setEmail($faker->unique()->email);
            $apprenant->setNom('nom');
            $apprenant->setPrenom($faker->firstName);
            $apprenant->setGenre($faker->randomElement(['homme', 'femme']));
            $apprenant->setAdresse($faker->address);
            $apprenant->setTelephone(770912122);

            $apprenant->addGroupe($this->getReference($i));
            $manager->persist($apprenant);
            
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
