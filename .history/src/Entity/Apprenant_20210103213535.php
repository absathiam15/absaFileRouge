<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
 
/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * @ORM\Table(name="`apprenant`")
 * @ApiResource(
 * normalizationContext={"groups"={"read"}},
 * denormalizationContext={"groups"={"write"}},
 * attributes={"security"="is_granted('ROLE_ADMIN')",
 *             "security_message"="Vous n'avez pas access à cette Ressource"},
 * collectionOperations={
 *      "get_apprenants"={
 *          "method"="get",
 *          "path"="/apprenants"
 *        },
 * 
 *      "add_apprenant" = {
 *          "method" = "POST",
 *          "path" = "/apprenants"
 *      }
 *    }
 * )
 * 
 */
class Apprenant extends User
{
    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="apprenants", cascade={"persist"})
     * @Groups({"groupe:write", "group:read", "profilSortie:write"})
     */
    private $promo;

    /**
     * @ORM\ManyToOne(targetEntity=ProfilSortie::class, inversedBy="apprenants", cascade={})
     * 
     */
    private $profilSortie;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="apprenant")
     * @Groups({"group:read"})
     */
    private $groupes;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
    }


    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getProfilSortie(): ?ProfilSortie
    {
        return $this->profilSortie;
    }

    public function setProfilSortie(?ProfilSortie $profilSortie): self
    {
        $this->profilSortie = $profilSortie;

        return $this;
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
            $groupe->addApprenant($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeApprenant($this);
        }

        return $this;
    }
}
