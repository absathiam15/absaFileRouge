<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApprenantController extends AbstractController
{
    /**
     * @Route(
     * path="api/apprenants",
     * methods={"POST"},
     * 
     * )
     */
    public function addApprenants(Request $request)
    {
        
        $apprenant = $request->request->all();

        $avatar = $request->files->get("avatar");
       
        $avatar = fopen($avatar->getRealPath(), "rb"); 
        $apprenant["avatar"] = $avatar;
        // dd($apprenant);
        $app = $this->serializer->denormalize($apprenant, "App\Entity\Apprenant");
        $app->setAvatar($avatar);
        
        $app->setPassword($this->encoder->encodePassword($app, "password"));

        $this->manager->persist($app);
        $this->manager->flush();
        fclose($avatar);
        return true;
               
        // $appobjet = $this->$serializer->serialize($apprenant, 'App\Entity\User');
        // dd(appobjet);
        // $appobjet->$this->getAvatar();
    }
}
