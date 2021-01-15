<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Apprenant;
use App\DataFixtures\GroupeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ApprenantFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        // $apprenant = new Apprenant();
        for ($i=0; $i < 5; $i++) { 
            # code... 
            $apprenant = new Apprenant;
            $apprenant->setUsername('name'.uniqid());
            $apprenant->addGroupe($this->getReference($i));
            $apprenant->setPassword($this->encoder->EncodePassword($apprenant, 'password'));
            $apprenant->setEmail($faker->unique()->email);
            $apprenant->setNom('nom');
            $apprenant->setPrenom($faker->firstName);
            $apprenant->setGenre($faker->randomElement(['homme', 'femme']));
            $apprenant->setAdresse($faker->address);
            $apprenant->setTelephone(770912122);
            $promo->addGroupeCompe($this->getReference($i));

            $manager->persist($apprenant);
            
        }
        $manager->flush();
           
    }

    public function getDependencies()
    {
        return array(
            GroupeFixtures::class,
        );
    }
}
