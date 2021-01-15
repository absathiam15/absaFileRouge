<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Apprenant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ApprenantFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $apprenant = new Apprenant();
        $i=0;
            $apprenant->addGroupe($this->getReference($i));

            $manager->persist($apprenant);
            $manager->flush();
    }
}
