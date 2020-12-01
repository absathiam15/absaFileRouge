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
     * methods={"POST"}
     * )
     */
    public function addApprenants(Request $request,EntityManagerInterface $manager, ProfilRepository $profilrepo, SerializerInterface $serializer, UserPasswordEncoderInterface $encoder)
    {

        $apprenant = $request->request->all();

        $avatar = $request->files->get("avatar");
        $avatar = fopen($avatar->getRealPath(), "r+"); 
        $apprenant["avatar"] = $avatar;
        $apprenant['profil'] = "Apprenant";
        
    //    dd($apprenant);
        $app = $serializer->denormalize($apprenant, Apprenant::class, true);
       
        $app->setUsername($apprenant["username"]);
        
        dd($app);
        $app->setPassword($encoder->encodePassword($app, "password"));
        
        $manager->persist($app);
        $manager->flush();
        return $this->json("Vous avez enrégistré un nouveau apprenant",200);        
    }
}


