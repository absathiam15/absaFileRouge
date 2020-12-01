<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfilFixtures extends Fixture
{

    const TAB=['ADMIN','APPRENANT','FORMATEUR','CM'];
    private $tabCode=['ADM','APP','FMT','CM'];


    public function load(ObjectManager $manager)
    {
        for ($p=0;$p<count(tab);$p++){
            $profil= new Profil();
            $profil->setLibelle(self::TAB[$p]);
            $profil->setCode($this->tabCode[$p]);
            $this->addReference(self::TAB[$p],$profil);
            $manager->persist($profil);
        }
        $manager->flush();
    }
   
}
