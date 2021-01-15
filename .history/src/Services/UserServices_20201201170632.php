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

    public function getRealProfil($profil){
        $profil = explode("/")
    }
    public function addUsers($user, $request) {

        $userObjet = $request->request->all();
        $this->getRealProfil($userObjet["profil"]);
        $avatar = $request->files->get("photo");
        $avatar = fopen($avatar->getRealPath(), "rb"); 
        $userObjet["photo"] = $avatar;
        
        $user = $this->serializer->denormalize($userObjet, "App\Entity\User");

        $user->setAvatar($avatar);
        
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
