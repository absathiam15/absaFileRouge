<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Profil;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class UserDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function supports($data, array $context = []): bool
    {
      $this->em
        return $data instanceof Profil;
    }

    public function persist($data, array $context = [])
    {
      $this->entityManager->persist($data);
      $this->entityManager->flush(); 
      return $data;
    }

    public function remove($data, array $context = [])
    {
      $data->setIsDeleted(true);
      $this->entityManager->persist($data);
      $this->entityManager->flush();
    }
}
