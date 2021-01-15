<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetencesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CompetencesRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"comp:read"}},
 * denormalizationContext={"groups"={"comp:write"}},
 * attributes={"security"="is_granted('ROLE_ADMIN')",
 *             "security_message"="Vous n'avez pas access à cette Ressource"},
 * collectionOperations={
 *      "get_competences" = {
 *          "method" = "GET",
 *          "path" = "/admin/competences"
 *          },
 *      "add_competences" = {
 *          "method" = "POST",
 *          "path" = "/admin/competences"
 *          }
 *      },
 * itemOperations={
 *      "get_competence" = {
 *      "method" = "GET",
 *      "path" = "/admin/competences/{id}"
 *    },
 *      "put_competence" = {
 *          "method" = "PUT",
 *          "path" = "/admin/competences/{id}"
 *    },
 *      "delete_competence" = {
 *          "method" = "DELETE",
 *          "path" = "/admin/competences/{id}"
 *    }
 * }
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
     * @Groups({"comp:read", "comp:write", "grpComp:write", "grpComp:read"})
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetences::class, inversedBy="competences")
     * @Groups({"comp:read", "comp:write"})
     */
    private $groupeCompetences;

    /**
     * @ORM\OneToMany(targetEntity=Referentiel::class, mappedBy="competences")
     * @Groups({"comp:read", "comp:write"})
     */
    private $referentiel;

    /**
     * @ORM\OneToMany(targetEntity=NiveauxEvaluation::class, mappedBy="competences", cascade={"persist"}))
     * @Groups({"comp:read", "comp:write", "grpComp:read", "grpComp:write"})
     * @Assert\Count(
     *      min = 3,
     *      max = 3,
     *      minMessage
     * )
     */
    private $niveauxEvaluations;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted = 0;

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
