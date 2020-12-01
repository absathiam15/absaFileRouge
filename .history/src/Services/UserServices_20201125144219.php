<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserServices 
{
        private $serializer;
        private $manager;
        private $encoder;
    public function __construct(EntityManagerInterface $manager, SerializerInterface $serializer, UserPasswordEncoderInterface $encoder) {
        
        $this->serializer = $serializer;
        $this->manager = $manager;
        $this->encoder = $encoder;
    }
    public function addUsers($user, $request) {

        $userObjet = $request->request->all();

        $avatar = $request->files->get("photo");
        $avatar = fopen($avatar->getRealPath(), "rb"); 
        $userObjet["photo"] = $avatar;
       
        $user = $this->serializer->denormalize($userObjet, "App\Entity\User");
        $user->setAvatar($avatar);
        //$user->setUsername($userObjet["username"]);
        $user->setTelephone($userObjet["telephone"]);
    
        $user->setPassword($this->encoder->encodePassword($user, "password"));

        $this->manager->persist($user);
        $this->manager->flush();
        fclose($avatar);
        return true;
    }
}
foreach ($profilTab as $profil) {
    if ($profil->getLibelle() == $pf) {
        if ($pf == "APPRENANT") {
            $class="App\Entity\Apprenant";
        }

        else if ($pf == "FORMATEUR") {
            $class="App\Entity\Formateur";
        }

        else if ($pf == "CM") {
            $class="App\Entity\Cm";
        }

        else if ($pf == "ADMIN") {
            $class="App\Entity\Admin";
        }
        
       else{
           new JsonResponse("Profil inexistant");
       } 
        
    }
}
   $requete = $this->dn->denormalize($requete, $class, null);
   $requete->setStatut(true);
   $requete->setProfils($profil);
   $requete->setPhoto($photo);
   $requete->setPassword($this->encode->encodePassword($requete, $requete->getPassword()));
   $this->manage->persist($requete);
   $this->manage->flush();  

   return true;