<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
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

    public function uploadImage($avatar, $user)
    {
        $avatar = fopen($avatar->getRealPath(), "rb"); 
        $user->setAvatar($avatar);
        return $user;
    }

    public function getRealProfil($profil)
    {
        $profil = explode("/",$profil);
        $profil_id=count($profil) -1;
        return $profil[$profil_id];
    }

    public function addUsers($user, $request, $profilRepo) 
    {
        $userObjet = $request->request->all();
        $profil_id = $this->getRealProfil($userObjet["profil"]);
        $profil = $profilRepo->find($profil_id);

        $entity = ucfirst(strtolower($profil->getLibelle($profil)));
        

        $entity = "App\Entity\\".$entity;
        $user_to_save = $this->serializer->denormalize($userObjet, $entity);
        $user_to_save->setProfil($profil);
        $avatar = $request->files->get("avatar");
        $user_to_save->setAvatar($this->uploadImage($avatar,$user));
        
        $user_to_save->setPassword($this->encoder->encodePassword($user, "password"));
        //dd($user_to_save);

        $this->manager->persist($user_to_save);
        $this->manager->flush();
      
        return true;
    }

}

