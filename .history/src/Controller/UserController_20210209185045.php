<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProfilRepository;
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
    private $manager;
    public function __construct(UserServices $userServices, EntityManagerInterface $manager) 
    {
        $this->userServices = $userServices;
        $this->manager = manager
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
    public function addUser(Request $request, ProfilRepository $profilRepo) 
        {
            $user = new User();
            
           if( $this->userServices->addUsers($user, $request, $profilRepo))
           {
            //return $this->json('test');
            $user1 = $this->userServices->addUsers($user, $request, $profilRepo);
            $this->manager->persist($user1);
            $this->manager->flush();
            return new JsonResponse("l'utilisateur a été enregistré avec success", Response::HTTP_CREATED, [], true);
          
        }
        }

        public function getRealProfil($profil)
    {
        $profil = explode("/",$profil);
        $profil_id=count($profil) -1;
        return $profil[$profil_id];
    }

    /**
     * @Route( path="/api/admin/users/{id}", methods={"PUT"})
     */
    public function updateUser(UserRepository $userRepo, $id, Request $request, ProfilRepository $profilRepo, EntityManagerInterface $manager, SerializerInterface $serializer){
       
        $user = $userRepo->find($id);
       // dd($user);
        $data = $request->request->all();
        $avatar = $request->files->get("avatar");
        $avatar = fopen($avatar->getRealPath(), "rb"); 
        $data["photo"] = $avatar;

        $profil_id = $this->getRealProfil($data["profil"]);
        $profil = $profilRepo->find($profil_id);
        

        $entity = ucfirst(strtolower($profil->getLibelle($profil)));
        $entity = "App\Entity\\".$entity;
       // dd($entity);

        $data = $this->serializer->denormalize($user, $entity);

        foreach ($data as $attribute_key => $attribute_value) {
            $method_set="set".ucfirst($attribute_key);
            if ($attribute_key!="_method") {
                $user->$method_set($attribute_value);
            }    
        }

        dd($data);
        $this->manager->persist($data);
        $this->manager->flush();
            return new JsonResponse("La modification a été enregistré avec success", Response::HTTP_CREATED, [], true);

    }
}
