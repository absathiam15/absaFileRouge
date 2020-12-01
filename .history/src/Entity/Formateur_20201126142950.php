<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ORM\Table(name="`formateur`")
 * @ApiResource(
 * itemOperations={
 *      get_formateurs = {
 *          "method" = "GET",
 *          "path" = "/format"
 * }
 * )
 */
class Formateur extends User
{
    
}
