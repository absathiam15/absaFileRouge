<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

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
    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="formateur")
     * @Groups({"groupe:write", "group:read", "format:read"})
     */
    private $groupes;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addFormateur($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeFormateur($this);
        }

        return $this;
    }
}
