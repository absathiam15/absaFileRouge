<?php

namespace App\DataFixtures;

use App\Entity\Cm;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{ 
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($p=0;$p<16;$p++) {
            if ($p<4){
                $user = new User();
               $user ->setProfil($this->getReference('ADMIN'));
            }
             elseif  ($p<8){
                $user = new Formateur();
                $user ->setProfil($this->getReference('FORMATEUR'));
            }
             elseif  ($p<12){
                $user = new Apprenant();
                $user ->setProfil($this->getReference('APPRENANT'));
            }
             else{
                $user = new Cm();
               $user  ->setProfil($this->getReference('CM'));
            }

            $user->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setUsername($faker->unique()firstName)
                ->setGenre($faker->randomElement(['homme', 'femme']))
                ->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($user, 'password'))
                ->setAdresse($faker->address)
                ->setTelephone(770912122);
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
             // TODO: Implement getDependencies() method.
        return array(
            ProfilFixtures::class
        );

    }
}