<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ReferentielFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $referentiel->setLibelle($faker->lastName)
        ->setPresentation($faker->firstName)
        ->setUsername($faker->unique()->userName)
        ->setGenre($faker->randomElement(['homme', 'femme']))
        ->setEmail($faker->email)
        ->setPassword($this->encoder->encodePassword($user, 'password'))
        ->setAdresse($faker->address)
        ->setTelephone(770912122);
    $manager->persist($user);

        $manager->flush();
    }
}
