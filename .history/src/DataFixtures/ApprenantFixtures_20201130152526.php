<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Apprenant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ApprenantFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $apprenant = new Apprenant();
        $user->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setUsername($faker->firstName)
                ->setGenre($faker->randomElement(['homme', 'femme']))
                ->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($user, 'password'))
                ->setAdresse($faker->address)
                ->setTelephone(770912122);
            $manager->persist($user);

        $this->addReference(self::GROUPE_REFERENCE, $groupe);

            $manager->flush();
        
        
    }
}
