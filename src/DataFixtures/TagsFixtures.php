<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tags;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 6; $i++) { 
            $tags = new Tags();
        $tags->setLibelle('cfffhsf');
    
        $manager->persist($tags);
        }
        $manager->flush();
    }
        
}
