<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\GroupeCompetences;
use Doctrine\ORM\EntityManagerInterface;

class UserDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof GroupeCompetences;
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
