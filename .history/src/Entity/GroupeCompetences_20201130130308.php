<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeCompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GroupeCompetencesRepository::class)
 * @ApiResource(
 * denormalizationContext={"groups"={"grpComp:write"}},
 * normalizationContext={"groups"={"grpComp:read"}},
 * collectionOperations={
 *      "add_grpecompetences" = {
 *          "method" = "POST",
 *          "path" = "/admin/grpecompetences"
 *         },
 *      "get_grpecompetences" = {
 *          "method" = "GET",
 *          "path" = "/admin/grpecompetences"
 *         }
 *     },
 * itemOperations={
 *      "get_grpecompetence" = {
 *          "method" = "GET",
 *          "path" = "/admin/grpecompetences/{id}"
 *        },
 *      "get_grpeCompet_compet" = {
 *          "method" = "GET",
 *          "path" = "/admin/grpecompetences/{id}/competences"
 *        },
 *      "put_grpeCompet" = {
 *          "method" = "PUT",
 *          "path" = "/admin/grpecompetences/{id}"
 *        },
 *      "delete_grpeCompet" = {
 *          "method" = "DELETE",
 *          "path" = "/admin/grpecompetences/{id}"
 *        }
 *    }
 * )
 */
class GroupeCompetences
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grpComp:write", "grpComp:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups({"grpComp:write", "grpComp:read"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Competences::class, mappedBy="groupeCompetences", cascade={"persist"})
     * @Groups({"grpComp:write", "grpComp:read"})
     */
    private $competences;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted = 0;

    /**
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="groupeCompetences")
     */
    private $apprenant;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="groupeCompetences")
     */
    private $formateur;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->apprenant = new ArrayCollection();
        $this->formateur = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Competences[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->addGroupeCompetence($this);
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            $competence->removeGroupeCompetence($this);
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
}
