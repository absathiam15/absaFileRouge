<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReferentielController extends AbstractController
{
    /**
     * @Route(
     * name="addUser",
     * path="/api/admin/referentiels/{idr}/grpecompetences/{idc}",
     * methods={"GET"},
     * defaults={
     *      "_controller"="\app\ControllerReferentielController::get_compet_GrpComp",
     *      "_api_resource_class"=User::class,
     *      "_api_collection_operation_name"="add_user",
     *    }
     * )
     */
    public function index()
    {
        dd('dfghjk');
    }
} 
