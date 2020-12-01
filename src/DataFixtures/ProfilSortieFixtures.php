<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\ProfilSortie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfilSortieFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        

            $manager->flush();
        
    }
}
