<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Repository\ApprenantRepository;
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
    public function addApprenants(Request $request)
    {
        
        $apprenant = $request->request->all();
        
        // $appobjet = $this->$serializer->serialize($apprenant, 'App\Entity\User');
        // dd(appobjet);
        // $appobjet->$this->getAvatar();
    }
}
