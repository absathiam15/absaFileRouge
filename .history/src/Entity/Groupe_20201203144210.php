<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"group:read"},"enable_max_depth"=true},
 * denormalizationContext={"groups"={"groupe:write"}},
 * collectionOperations={
 *      "add_groupes" = {
 *          "method" = "POST",
 *          "path" = "admin/groupes"
 *          },
 *      "get_groupes_apprenants" = {
 *          "method" = "GET",
 *          "path" = "admin/groupes/apprenants"
 *          },
 *      "get_groupes" = {
 *          "method" = "GET",
 *          "path" = "admin/groupes"
 *          }
 *      }
 * )
 */
class Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"group:read"})
     */
    private $id;
 
    /**
     * @ORM\Column(type="integer")
     * @Groups({"groupe:write", "group:read"})
     */
    private $numero;

    /**
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="groupes", cascade={"persist"})
     * @Groups({"groupe:write", "group:read"})
     * @MaxDepth(2)
     */
    private $apprenant;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="groupes", cascade={"persist"})
     * @Groups({"groupe:write", "group:read"})
     * @MaxDepth(2)
     */
    private $formateur;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="groupe")
     */
    private $promo;

    public function __construct()
    {
        $this->apprenant = new ArrayCollection();
        $this->formateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenant(): Collection
    {
        return $this->apprenant;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenant->contains($apprenant)) {
            $this->apprenant[] = $apprenant;
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        $this->apprenant->removeElement($apprenant);

        return $this;
    }

    /**
     * @return Collection|Formateur[]
     */
    public function getFormateur(): Collection
    {
        return $this->formateur;
    }

    public function addFormateur(Formateur $formateur): self
    {
        if (!$this->formateur->contains($formateur)) {
            $this->formateur[] = $formateur;
        }

        return $this;
    }

    public function removeFormateur(Formateur $formateur): self
    {
        $this->formateur->removeElement($formateur);

        return $this;
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

}
