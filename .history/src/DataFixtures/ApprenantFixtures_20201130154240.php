<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Apprenant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ApprenantFixtures extends Fixture
{
    public const GROUPE_REFERENCE = 'groupe';

    public function load(ObjectManager $manager)
    {
        // $faker= Factory::create('fr_FR');

        $apprenant = new Apprenant();
        

            $apprenant->addUser($this->getReference(GroupeFixtures::GROUPE_REFERENCE));

            $manager->persist($apprenant);
            $manager->flush();
    }
}
