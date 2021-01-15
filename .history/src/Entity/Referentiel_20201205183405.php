<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferentielRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * denormalizationContext={"groups"={"referentiel:write"}},
 *  collectionOperations={
 *      "add_referentiel"={
 *          "method"="POST",
 *          "path"="/admin/referentiels"
 *        },
 *      "get_referentiel_grpComp_compet"={
 *          "method"="GET",
 *          "path"="/admin/referentiels/grpecompetences",
 *          "normalization_context"={"groups"={"referentiel:read"}}
 *        },
 *      "get_referentiel_grpCompet"={
 *          "method"="GET",
 *          "path"="/admin/referentiels",
 *          "normalization_context" = {"groups"={"ref:read"}}
 *        }
 *   }
 * )
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 */
class Referentiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"group:read", "referentiel:write", "referentiel:read", "ref:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"group:read", "referentiel:write", "referentiel:read", "ref:read"})
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"group:read", "referentiel:write", "referentiel:read", "ref:read"})
     */
    private $programme;

    /**
     * @ORM\OneToMany(targetEntity=CritereAdmission::class, mappedBy="referentiel")
     * @Groups({"group:read"})
     */
    private $critereAdmissions;

    /**
     * @ORM\OneToMany(targetEntity=CritereEvaluation::class, mappedBy="referentiel")
     * @Groups({"group:read"})
     */
    private $critereEvaluations;

    /**
     * @ORM\ManyToMany(targetEntity=Promo::class, mappedBy="referentiel")
     * @Groups({"referentiel:write"})
     */
    private $promos;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetences::class, inversedBy="referentiels")
     * @Groups({"referentiel:write", "referentiel:read", "ref:read"})
     */
    private $groupeCompetences;

    public function __construct()
    {
        $this->critereAdmissions = new ArrayCollection();
        $this->critereEvaluations = new ArrayCollection();
        $this->promos = new ArrayCollection();
        $this->groupeCompetences = new ArrayCollection();
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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    /**
     * @return Collection|CritereAdmission[]
     */
    public function getCritereAdmissions(): Collection
    {
        return $this->critereAdmissions;
    }

    public function addCritereAdmission(CritereAdmission $critereAdmission): self
    {
        if (!$this->critereAdmissions->contains($critereAdmission)) {
            $this->critereAdmissions[] = $critereAdmission;
            $critereAdmission->setReferentiel($this);
        }

        return $this;
    }

    public function removeCritereAdmission(CritereAdmission $critereAdmission): self
    {
        if ($this->critereAdmissions->removeElement($critereAdmission)) {
            // set the owning side to null (unless already changed)
            if ($critereAdmission->getReferentiel() === $this) {
                $critereAdmission->setReferentiel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CritereEvaluation[]
     */
    public function getCritereEvaluations(): Collection
    {
        return $this->critereEvaluations;
    }

    public function addCritereEvaluation(CritereEvaluation $critereEvaluation): self
    {
        if (!$this->critereEvaluations->contains($critereEvaluation)) {
            $this->critereEvaluations[] = $critereEvaluation;
            $critereEvaluation->setReferentiel($this);
        }

        return $this;
    }

    public function removeCritereEvaluation(CritereEvaluation $critereEvaluation): self
    {
        if ($this->critereEvaluations->removeElement($critereEvaluation)) {
            // set the owning side to null (unless already changed)
            if ($critereEvaluation->getReferentiel() === $this) {
                $critereEvaluation->setReferentiel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
            $promo->addReferentiel($this);
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        if ($this->promos->removeElement($promo)) {
            $promo->removeReferentiel($this);
        }

        return $this;
    }

    /**
     * @return Collection|GroupeCompetences[]
     */
    public function getGroupeCompetences(): Collection
    {
        return $this->groupeCompetences;
    }

    public function addGroupeCompetence(GroupeCompetences $groupeCompetence): self
    {
        if (!$this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences[] = $groupeCompetence;
            $groupeCompetence->setReferentiel($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetences $groupeCompetence): self
    {
        if ($this->groupeCompetences->removeElement($groupeCompetence)) {
            // set the owning side to null (unless already changed)
            if ($groupeCompetence->getReferentiel() === $this) {
                $groupeCompetence->setReferentiel(null);
            }
        }

        return $this;
    }
}
