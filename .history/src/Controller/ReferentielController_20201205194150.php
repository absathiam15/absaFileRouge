<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReferentielController extends AbstractController
{
    /**
     * @Route(
     * path="/api/admin/referentiels/{idr}/grpecompetences/{idc}",
     * methods={"GET"},
     * defaults={
     *      "_controller"="\app\ControllerReferentielController::get_compet_GrpComp",
     *      "_api_resource_class"=Referentiel::class,
     *    }
     * )
     */
    public function get_compet_GrpComp()
    {
        dd('dfghjk');
    }
} 
