<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Groupe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeFixtures extends Fixture
{
    public const GROUPE_REFERENCE = 'groupe';
    

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $groupe = new Groupe();
        $groupe->setNumero(2);


        $manager->persist($groupe);
        $manager->flush();
    }
}
 