<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Promo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PromoFixtures extends Fixture
{
    public const PROMO_REFERENCE = 'promo';

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $promo = new Promo();
        $promo->setAnnee($faker->date($format = 'Y-m-d', $max = 'now'))
        ->setDebut($faker->date($format = 'Y-m-d', $max = 'now'))
        ->setFin($faker->date($format = 'Y-m-d', $max = 'now'))
        ->setLieuPromo($faker->lieuPromo)
        ->setChoixFabrique($faker->choixFabrique)
        ->setReference($this->reference)
        ->setTitre($faker->titre)
        ->setDescription($faker->description);
        ->setEffectifEntrant($faker->effectifEntrant);
        ->setDescription($faker->description);
        ->setDescription($faker->description);
        ->setDescription($faker->description);

    $manager->persist($user);

            $manager->flush();
        

        
    }
}
