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

    public function getRealProfil($profil){
        $profil = explode("/",$profil);
        $profil_id=count($profil) -1;
        return $profil[$profil_id];
    }
    public function addUsers($user, $request, $profilRepo) {

        $userObjet = $request->request->all();
        $profil_id = $this->getRealProfil($userObjet["profil"]);
        //dd($profil_id);
        $profil = $profilRepo->find($profil_id);
        $entity = ucfirst(strtolower($profil->getLibelle($profil)));
        $entity = "App\Entity\\".$entity;
     

        
        
        $user = $this->serializer->denormalize($userObjet, $entity);
        $avatar = $request->files->get("avatar");
        $user_to_save=$this->uploadImage($avatar,$user);
        dd($user_to_save);
        
        $user->setPassword($this->encoder->encodePassword($user, "password"));

        $this->manager->persist($user);
        $this->manager->flush();
      
        return true;
    }

    // public function put_user($id,$request,$userRepo){
    //     $user=$userRepo->find($id);
    //     $message = "cet utilisateur n'existe pas";
    //     if(empty($user)){
    //         return $message;
    //     }
    //     $data=$request->request->all();
        
    //     foreach ($data as $attribute_key => $attribute_value) {
    //         $method_set="set".ucfirst($attribute_key);
    //         if ($attribute_key!="_method") {
    //             $user->$method_set($attribute_value);
    //         }    
    //     }
    //     $image=($request->files->get("avatar"));
    //     if(!empty($image)){
    //         $this->upload_image($image,$user);
    //     }
    //     return $user;
    // }
}
// 
