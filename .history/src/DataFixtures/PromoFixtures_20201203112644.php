<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Promo;
use App\DataFixtures\GroupeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PromoFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 5; $i++) { 
            # code...
        }
        
    }

    public function getDependencies()
    {
        return array(
        GroupeFixtures::class,
        );
    }
}

