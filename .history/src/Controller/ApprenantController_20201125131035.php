<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function addApprenants(Request $request, EntityManagerInterface $manager)
    {
        
        $apprenant = $request->request->all();

        $avatar = $request->files->get("photo");
        $avatar = fopen($avatar->getRealPath(), "rb"); 
        $appe["photo"] = $avatar;
               
        // $appobjet = $this->$serializer->serialize($apprenant, 'App\Entity\User');
        // dd(appobjet);
        // $appobjet->$this->getAvatar();
    }
}
