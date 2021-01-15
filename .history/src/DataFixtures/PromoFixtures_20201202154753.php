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
        ->setLieuPromo($faker->pro)
        ->setEmail($faker->email)
        ->setPassword($this->encoder->encodePassword($user, 'password'))
        ->setAdresse($faker->address)
        ->setTelephone(770912122);
    $manager->persist($user);

            $manager->flush();
        

        
    }
}
