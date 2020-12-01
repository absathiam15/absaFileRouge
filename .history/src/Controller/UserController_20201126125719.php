<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\UserServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
    private $userServices;
    public function __construct(UserServices $userServices) 
    {
        $this->userServices = $userServices;
    }
    /**
     * @Route(
     * name="addUser",
     * path="/api/admin/users",
     * methods={"POST"},
     * defaults={
     *      "_controller"="\app\ControllerUserController::addUser",
     *      "_api_resource_class"=User::class,
     *      "_api_collection_operation_name"="add_user",
     *      
     *    }
     * )
     */
    public function addUser( Request $request) 
        {
            $user = new User();
            
           if( $this->userServices->addUsers($user, $request))
           {
            return new JsonResponse("l'utilisateur a été enregistré avec success", Response::HTTP_CREATED, [], true);
           }
        }

    /**
     * @Route(
     * name="updateUser1",
     * path="/api/admin/users/{id}",
     * methods={"PUT"}
     * )
     */
    public function updateUser($id, UserRepository $user, Request $request, EntityManagerInterface $manager)
    {
        $user = $manager->getRepository(User::class)->find($id);
       
    }
}
