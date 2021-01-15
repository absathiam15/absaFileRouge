<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Groupe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeFixtures extends Fixture
{
    

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $groupe = new Groupe();
        $groupe->setNumero(2);

        $promo->addGroupe($this->getReference(GroupeFixtures::PROMO_REFERENCE));

        $manager->persist($groupe);
        $manager->flush();
    }
}
 