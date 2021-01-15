<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Groupe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeFixtures extends Fixture
{
    public const PROMO_REFERENCE = 'promo';
    

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $groupe = new Groupe();
        $groupe->setNumero(2);

        $groupe->addPromo($this->getReference(PomoFixtures::PROMO_REFERENCE));

        $manager->persist($groupe);
        $manager->flush();
    }
}
 