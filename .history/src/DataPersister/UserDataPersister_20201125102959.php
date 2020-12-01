<?php

namespace App\DataPersister;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class UserDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = [])
    {
      $this->entityManager->persist($data);
      $this->entityManager->flush();
      return $data;
      return new JsonResponse("l'utilisateur a été enregistré avec success", Response::HTTP_CREATED, [], true);

    }

    public function remove($data, array $context = [])
    {
      $data->setIsDeleted(true);
      $this->entityManager->persist($data);
      $this->entityManager->flush();
      return new JsonResponse("l'utilisateur a été enregistré avec success", Response::HTTP_CREATED, [], true);

    }
}
