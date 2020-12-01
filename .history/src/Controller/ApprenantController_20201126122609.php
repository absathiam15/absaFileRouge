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
    public function addApprenants(Request $request,EntityManagerInterface $manager, ProfilRepository $profilrepo, SerializerInterface $serializer, UserPasswordEncoderInterface $encoder)
    {

        $apprenant = $request->request->all();

        $avatar = $request->files->get("avatar");
        $avatar = fopen($avatar->getRealPath(), "rb"); 
        $apprenant["avatar"] = $avatar;
       
        $app = $serializer->denormalize($apprenant, 'App\Entity\Apprenant', true);
        
        
        $app->setAvatar($avatar);
    
        $app->setPassword($encoder->encodePassword($app, "password"));
        // dd($app);

        $manager->persist($app);
        $manager->flush();
        fclose($avatar);
        return $this->json("Vous avez enrégistré un nouveau apprennat",200);        
    }
}


