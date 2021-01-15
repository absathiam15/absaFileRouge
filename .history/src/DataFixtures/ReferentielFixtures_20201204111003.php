<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Referentiel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ReferentielFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 8; $i++) { 
        $referentiel = new Referentiel();
        $referentiel
        ->setLibelle("gfdgfghjhkjlkml")
        ->setPresentation($faker->presentation)
        ->setProgramme($faker->programme)
        ->setGenre($faker->randomElement(['homme', 'femme']))
        ->setEmail($faker->email)
        ->setPassword($this->encoder->encodePassword($user, 'password'))
        ->setAdresse($faker->address)
        ->setTelephone(770912122);

      $referentiel->addGroupeCompetences($this->getReference($i));

    $manager->persist($user);

        $manager->flush();
        }
        
    }

    public function getDependencies()
    {
        return array(
            GroupeFixtures::class,
        );
    }
}
