<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ApprenantFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $apprenant = 

        $this->addReference(self::GROUPE_REFERENCE, $groupe);

            $manager->flush();
        
        
    }
}
