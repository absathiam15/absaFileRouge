<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApprenantController extends AbstractController
{
    /**
     * @Route(
     * name="addUser",
     * path="/api/admin/users",
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
        dd('sdfgdf')
    }
}
