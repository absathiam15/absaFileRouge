<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $user->setNom($faker->lastName)
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
