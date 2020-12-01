<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Repository\ApprenantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApprenantController extends AbstractController
{
    /**
     * @Route(
     * path="api/apprenants",
     * methods={"GET"},
     * defaults={
     *      "_controller"="\app\ControllerUserController::showApprenants",
     *      "_api_resource_class"=Apprenant::class,
     *      "_api_collection_operation_name"="get_apprenants"
     *    }
     * )
     */
    public function showApprenants()
    {
        $apprenant = ApprenantRepository
    }
}
