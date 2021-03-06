<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Groupe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'admin-user';
    
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $groupe = new Groupe();
        $groupe->setNumero($faker);

        $manager->flush();
    }
}
