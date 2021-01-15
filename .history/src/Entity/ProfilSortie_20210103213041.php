<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilSortieRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProfilSortieRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"profilSortie:read"}},
 * denormalizationContext={"groups"={"profilSortie:write"}},
 * collectionOperations={
 *      "get_admin_profilSorties" = {
 *          "method" = "GET",
 *          "path" = "/admin/profilsorties"
 *      },
 *  "add_profilSorties" = {
 *          "method" = "POST",
 *          "path" = "/admin/profilsorties",
 *          "denormalization_context" = {"groups":"profilSortie:write"}
 *      }
 * })
 */
class ProfilSortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profilSortie:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profilSortie:read", "profilSortie:write"})
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="profilSortie", cascade={"persist"})
     * @Groups({"profilSortie:read", "profilSortie:write"})
     */
    private $apprenants;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
            $apprenant->setProfilSortie($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getProfilSortie() === $this) {
                $apprenant->setProfilSortie(null);
            }
        }

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
}
