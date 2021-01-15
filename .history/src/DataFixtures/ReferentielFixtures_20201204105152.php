<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Referentiel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ReferentielFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $referentiel = new Referentiel();
        $referentiel->setLibelle("$faker->lastName")
        ->setPresentation($faker->presentation)
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
