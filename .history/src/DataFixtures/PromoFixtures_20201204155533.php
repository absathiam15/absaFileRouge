<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Promo;
use App\DataFixtures\GroupeFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\ReferentielFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PromoFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($i=0; $i < 5; $i++) { 
            
        $promo = new Promo();
            $promo 
            ->setLieuPromo($faker->city)
            ->setChoixFabrique($faker->text(5))
            ->setReference($faker->text(8))
            ->setTitre($faker->title())
            ->setDescription($faker->text(5))
            ->setEffectifEntrant(100)
            ->setEffectifSortant(90)

            ->addReferentiel($this->getReference($i))
            ->addGroupe($this->getReference($i));

            $manager->persist($promo);
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

