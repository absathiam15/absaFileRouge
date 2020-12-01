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
 * normalizationContext={"groups"={"grpComp"}},
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
 *          "path" = "/grpecompetences/{id}"
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
     * @Groups({"grpComp:write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups({"grpComp:write"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Competences::class, mappedBy="groupeCompetences", cascade={"persist"})
     * @Groups({"grpComp:write"})
     */
    private $competences;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
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
}
