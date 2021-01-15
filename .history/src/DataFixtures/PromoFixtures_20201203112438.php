<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Promo;
use App\DataFixtures\GroupeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PromoFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $promo = new Promo();
        $promo
        ->setLieuPromo($faker->city)
        ->setChoixFabrique($faker->text(5))
        ->setReference($this->reference)
        ->setTitre($faker->title())
        ->setDescription($faker->text(5))
        ->setEffectifEntrant($faker->(5))
        ->setEffectifSortant($faker->text(5));

        $promo->addGroupe($this->getReference(GroupeFixtures::GROUPE_REFERENCE));

        $manager->persist($promo);
        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
        GroupeFixtures::class,
        );
    }
}

