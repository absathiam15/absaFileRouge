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

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $apprenant = new Apprenant();
        $i=0;
            $apprenant->addGroupe($this->getReference($i));
            $apprenant->setUsername($faker->username);
            $apprenant->setPassword($this->encoder->EncodePassword($apprenant, 'password'));


            $manager->persist($apprenant);
            $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            GroupeFixtures::class,
        );
    }
}
