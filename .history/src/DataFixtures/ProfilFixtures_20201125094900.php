<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfilFixtures extends Fixture
{

    const tab=['ADMIN','APPRENANT','FORMATEUR','CM'];
    private $tabCode=['ADM','APP','FMT','CM'];


    public function load(ObjectManager $manager)
    {
        for ($p=0;$p<5;$p++){
            $profil= new Profil();
            $profil->setLibelle(self::tab[$p]);
            $profil->setCode($this->tabCode[$p]);
            $this->addReference(self::tab[$p],$profil);
            $manager->persist($profil);
        }
        $manager->flush();
    }
   
}
