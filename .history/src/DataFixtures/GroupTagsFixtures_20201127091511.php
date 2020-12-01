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

        $groupTags = new GroupTags();
        $groupTags->setLibelle('groupeTags');
    
        $manager->persist($groupTags);
        $manager->flush();
    }

    
}
