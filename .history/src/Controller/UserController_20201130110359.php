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
use Symfony\Component\Serializer\SerializerInterface;

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
     *    }
     * )
     */
    public function addUser(Request $request) 
        {
            $user = new User();
            
           if( $this->userServices->addUsers($user, $request))
           {
            return new JsonResponse("l'utilisateur a été enregistré avec success", Response::HTTP_CREATED, [], true);
           }
        }

    /**
     * @Route( path="/api/admin/users/{id}", methods={"PUT"})
     */
    public function updateUser(UserRepository $userRepo, $id, Request $request, EntityManagerInterface $manager, SerializerInterface $serializer){
       
        $user = $userRepo->find($id);
        $data = $request->request->all();
        dd()
        $avatar = $request->files->get("avatar");
        $avatar = fopen($avatar->getRealPath(), "rb"); 
        $userObjet["photo"] = $avatar;
        
        foreach ($data as $attribute_key => $attribute_value) {
            $method_set="set".ucfirst($attribute_key);
            if ($attribute_key!="_method") {
                $user->$method_set($attribute_value);
            }    
        }
        $data = $this->serializer->denormalize($dara, "App\Entity\User");

        dd($data);
        $this->manager->persist($data);
        $this->manager->flush();
            return new JsonResponse("La modification a été enregistré avec success", Response::HTTP_CREATED, [], true);

    }
}