<?php

namespace App\DataPersister;


use App\Entity\Competences;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class CompetencesDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Competences;
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
