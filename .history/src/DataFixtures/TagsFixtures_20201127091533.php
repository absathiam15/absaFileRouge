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

        $tags = new Tags();
        $tags->setLibelle('$faker->libelle');
    
        $manager->persist($tags);
        $manager->flush();
    }
}
