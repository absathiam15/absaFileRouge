<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PromoFixtures extends Fixture
{
    public const PROMO_REFERENCE = 'promo';

    public function load(ObjectManager $manager)
    {


            $manager->flush();
        

        
    }
}
