<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PromoFixtures extends Fixture
{
    public const PROMO_REFERENCE = 'promo';

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');
        
        $user->setAnnee($faker->date($format = 'Y-m-d', $max = 'now'))
        ->setPrenom($faker->firstName)
        ->setUsername($faker->firstName)
        ->setGenre($faker->randomElement(['homme', 'femme']))
        ->setEmail($faker->email)
        ->setPassword($this->encoder->encodePassword($user, 'password'))
        ->setAdresse($faker->address)
        ->setTelephone(770912122);
    $manager->persist($user);

            $manager->flush();
        

        
    }
}
