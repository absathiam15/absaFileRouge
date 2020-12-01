<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ORM\Table(name="`formateur`")
 * @ApiResource(
 * normalizationContext={"groups"={"format:read"}},
 * attributes={"security"="is_granted('ROLE_FORMATEUR')",
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
    
        if (!$this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences[] = $groupeCompetence;
            $groupeCompetence->addFormateur($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetences $groupeCompetence): self
    {
        if ($this->groupeCompetences->removeElement($groupeCompetence)) {
            $groupeCompetence->removeFormateur($this);
        }

        return $this;
    }
}
