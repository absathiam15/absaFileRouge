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
    public function addApprenants(Request $request, ProfilRepository $profilrepo, EntityManagerInterface $manager)
    {
        $class="";
        $apprenant = $request->request->all();
        $profils = $profilrepo->findAll();
        
        foreach ($profils as $profil ) {
            if ($profil->getLibelle() == $prof) {
                if ($prof == "ADMIN") {
                    $class = "App\Entity\Admin";
                }
                else if ($prof == "FORMATEUR") {
                    $class = "App\Entity\Formateur";
                }
                else if ($prof == "APPRENANT") {
                    $class = "App\Entity\Apprenant";
                }
                else if ($prof == "CM") {
                    $class = "App\Entity\Cm";
                }
                else new JsonResponse("Class inexistant")
            }
        }

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
               
    }
}
// class UserService 
// {
//     private $encode;
//     private $manage;
//     private $dn;
//     public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager, DenormalizerInterface $denormalizer)
//     {
//         $this->encode = $encoder;
//         $this->manage = $manager;
//         $this->dn = $denormalizer;
//     }
//     public function ajouter_user(Request $request, String $pf)
//     {
//         $requete = $request->request->all();
//         $photo= $request->files->get('photo');
//         $photo= fopen($photo->getRealPath(),"rb");
     
//         $class="";
       
//         $profilTab = $this->manage->getRepository(Profil::class)->findAll();
// foreach ($profilTab as $profil) {
    //     if ($profil->getLibelle() == $pf) {
    //         if ($pf == "APPRENANT") {
    //             $class="App\Entity\Apprenant";
    //         }
    
    //         else if ($pf == "FORMATEUR") {
    //             $class="App\Entity\Formateur";
    //         }
    
    //         else if ($pf == "CM") {
    //             $class="App\Entity\Cm";
    //         }
    
    //         else if ($pf == "ADMIN") {
    //             $class="App\Entity\Admin";
    //         }
            
    //        else{
    //            new JsonResponse("Profil inexistant");
    //        } 
            
    //     }
    // }
    //    $requete = $this->dn->denormalize($requete, $class, null);
    //    $requete->setStatut(true);
    //    $requete->setProfils($profil);
    //    $requete->setPhoto($photo);
    //    $requete->setPassword($this->encode->encodePassword($requete, $requete->getPassword()));
    //    $this->manage->persist($requete);
    //    $this->manage->flush();  
    
    //    return true;