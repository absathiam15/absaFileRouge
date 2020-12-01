<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetencesRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"comp:read"}},
 * collectionOperations={
 *      "get_competences" = {
 *          "method" = "GET",
 *          "path" = "/admin/competences"
 *          }
 *      }
 * )
 */
class Competences
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetences::class, inversedBy="competences")
     */
    private $groupeCompetences;

    /**
     * @ORM\OneToMany(targetEntity=Referentiel::class, mappedBy="competences")
     */
    private $referentiel;

    /**
     * @ORM\OneToMany(targetEntity=NiveauxEvaluation::class, mappedBy="competences")
     */
    private $niveauxEvaluations;

    public function __construct()
    {
        $this->groupeCompetences = new ArrayCollection();
        $this->referentiel = new ArrayCollection();
        $this->niveauxEvaluations = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetences $groupeCompetence): self
    {
        $this->groupeCompetences->removeElement($groupeCompetence);

        return $this;
    }

    /**
     * @return Collection|Referentiel[]
     */
    public function getReferentiel(): Collection
    {
        return $this->referentiel;
    }

    public function addReferentiel(Referentiel $referentiel): self
    {
        if (!$this->referentiel->contains($referentiel)) {
            $this->referentiel[] = $referentiel;
            $referentiel->setCompetences($this);
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        if ($this->referentiel->removeElement($referentiel)) {
            // set the owning side to null (unless already changed)
            if ($referentiel->getCompetences() === $this) {
                $referentiel->setCompetences(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NiveauxEvaluation[]
     */
    public function getNiveauxEvaluations(): Collection
    {
        return $this->niveauxEvaluations;
    }

    public function addNiveauxEvaluation(NiveauxEvaluation $niveauxEvaluation): self
    {
        if (!$this->niveauxEvaluations->contains($niveauxEvaluation)) {
            $this->niveauxEvaluations[] = $niveauxEvaluation;
            $niveauxEvaluation->setCompetences($this);
        }

        return $this;
    }

    public function removeNiveauxEvaluation(NiveauxEvaluation $niveauxEvaluation): self
    {
        if ($this->niveauxEvaluations->removeElement($niveauxEvaluation)) {
            // set the owning side to null (unless already changed)
            if ($niveauxEvaluation->getCompetences() === $this) {
                $niveauxEvaluation->setCompetences(null);
            }
        }

        return $this;
    }
}
