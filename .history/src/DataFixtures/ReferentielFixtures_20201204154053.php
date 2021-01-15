<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Referentiel;
use App\DataFixtures\PromoFixtures;
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

        // ->addGroupeCompetence($this->getReference($i))
        ->addPromo($this->getReference($i));

        $manager->persist($referentiel);

        }
        $manager->flush();
        
    }

    public function getDependencies()
    {
        return array(
            GrpeCompetencesFixtures::class,
        );
    }

    // public function getDependencies()
    // {
    //     return array(
    //         PromoFixtures::class,
    //     );
    // }
}
