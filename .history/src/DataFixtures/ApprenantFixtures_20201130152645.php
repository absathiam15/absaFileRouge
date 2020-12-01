<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Apprenant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ApprenantFixtures extends Fixture
{
    public const GROUPE_REFERENCE = 'groupe';
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $apprenant = new Apprenant();
        $apprenant->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setUsername($faker->firstName)
                ->setGenre($faker->randomElement(['homme', 'femme']))
                ->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($apprenant, 'password'))
                ->setAdresse($faker->address)
                ->setTelephone(770912122);
            $manager->persist($apprenant);

        $this->addReference(self::GROUPE_REFERENCE, $groupe);

            $manager->flush();
        
        
    }
}
