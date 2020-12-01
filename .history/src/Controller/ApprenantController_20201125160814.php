<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Repository\ApprenantRepository;
use App\Repository\ProfilRepository;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
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
    public function addApprenants(Request $request, ProfilRepository $profilrepo, DenormalizerAwareInterface $denormalizre)
    {
        dd('dgdfhds')
;        $class="";

        $apprenant = $request->request->all();
        // $profils = $profilrepo->findAll();
        
        // $prof ="";
        // foreach ($profils as $profil ) {
        //     if ($profil->getLibelle() == $prof) {
        //         if ($prof == "ADMIN") {
        //             $class = "App\Entity\Admin";
        //         }
        //         else if ($prof == "FORMATEUR") {
        //             $class = "App\Entity\Formateur";
        //         }
        //         else if ($prof == "APPRENANT") {
        //             $class = "App\Entity\Apprenant";
        //         }
        //         else if ($prof == "CM") {
        //             $class = "App\Entity\Cm";
        //         }
        //         else new JsonResponse("Class inexistant");
        //     }
        // }

        // $avatar = $request->files->get("avatar");
        // $avatar = fopen($avatar->getRealPath(), "rb"); 
        // $apprenant["avatar"] = $avatar;
        //     dd($apprenant);
        // $app = $this->serializer->denormalize($apprenant, 'App\Entity\Apprenant', true);
        // dd($apprenant);
        // $app->setAvatar($avatar);
    
        // $app->setPassword($this->encoder->encodePassword($app, "password"));
        
        // $this->manager->persist($app);
        // $this->manager->flush();
        fclose($avatar);
        return true;        
    }
}


