<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\CmRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CmRepository::class)
 * @ORM\Table(name="`cm`")
 */
class Cm extends User
{
   
}
