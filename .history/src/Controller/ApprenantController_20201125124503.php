<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Repository\ApprenantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class ApprenantController extends AbstractController
{
    /**
     * @Route(
     * path="api/apprenants",
     * methods={"POST"},
     * defaults={
     *      "_controller"="\app\ControllerApprenatController::addApprenants",
     *      "_api_resource_class"=Apprenant::class,
     *      "_api_collection_operation_name"="add_apprenant"
     *    }
     * )
     */
    public function addApprenants(ApprenantRepository $apprenant, SerializerInterface $serializer)
    {
        dd()
        // $apprenant = $apprenant->findAll();
        
        // $appobjet = $this->$serializer->serialize($apprenant, 'App\Entity\User');
        // dd(appobjet);
        // $appobjet->$this->getAvatar();
    }
}
