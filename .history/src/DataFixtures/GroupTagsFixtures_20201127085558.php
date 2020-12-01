<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupTagsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $tags = new Tags();
        $tags->setLibelle($faker->libelle);
    
            $manager->persist($tags);

        $manager->flush();
    }
}
