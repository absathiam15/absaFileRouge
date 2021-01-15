<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Referentiel;
use App\DataFixtures\PromoFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\CompetencesFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\GrpeCompetencesFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ReferentielFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < ; $i++) { 
        $referentiel = new Referentiel();
        $referentiel
        ->setLibelle("gfdgfghjhkjlkml")
        ->setPresentation($faker->text(5))
        ->setProgramme($faker->text(5))

        // ->addGroupeCompetence($this->getReference($i))
        ->addPromo($this->getReference($i));
        $this->addReference('referentiel'.$i, $referentiel);

        $manager->persist($referentiel);

        }
        $manager->flush();
        
    }

   

    // public function getDependencies()
    // {
    //     return array(
    //         PromoFixtures::class,
    //     );
    // }
}
