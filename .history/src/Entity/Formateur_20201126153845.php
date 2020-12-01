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
 * normalizationContext={"groups"={"format:read"}},
 * "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))",
 *             "security_message"="Vous n'avez pas access à cette Ressource"},
 * itemOperations={
 *      "get_formateur" = {
 *          "method" = "GET",
 *          "path" = "/formateurs/{id}"
 *        }
 *      }
 * )
 */
class Formateur extends User
{
    
}
