<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\GroupTags;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupTagsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 6; $i++) { 
            $groupTags = new GroupTags();
            $groupTags->setLibelle('hgfdsdfg');
            $manager->persist($groupTags);
        }
        
        $manager->flush();
    }

    
}
