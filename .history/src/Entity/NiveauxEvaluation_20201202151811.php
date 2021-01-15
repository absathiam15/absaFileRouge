<?php

namespace App\Entity;

use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NiveauxEvaluationRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=NiveauxEvaluationRepository::class)
 */
class NiveauxEvaluation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"comp:read", "comp:write", "grpComp:read", "grpComp:write"})
     *  @Assert\Count(
     *      min = 3,
     *      max = 3,
     *      minMessage = "Ajouter au minimum 3 niveaux",
     *      maxMessage = "Ajouter au maximum 3 niveaux"
     * )
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups({"comp:read", "comp:write", "grpComp:read", "grpComp:write"})
     *  @Assert\Count(
     *      min = 3,
     *      max = 3,
     *      minMessage = "Ajouter au minimum 3 niveaux",
     *      maxMessage = "Ajouter au maximum 3 niveaux"
     * )
     */
    private $criteres;
    

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups({"comp:read", "comp:write", "grpComp:read", "grpComp:write"})
     *  @Assert\Count(
     *      min = 3,
     *      max = 3,
     *      minMessage = "Ajouter au minimum 3 niveaux",
     *      maxMessage = "Ajouter au maximum 3 niveaux"
     * )
     */
    private $actions;

    /**
     * @ORM\ManyToOne(targetEntity=Competences::class, inversedBy="niveauxEvaluations")
     */
    private $competences;

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

    public function getCriteres(): ?string
    {
        return $this->criteres;
    }

    public function setCriteres(string $criteres): self
    {
        $this->criteres = $criteres;

        return $this;
    }

    public function getActions(): ?string
    {
        return $this->actions;
    }

    public function setActions(string $actions): self
    {
        $this->actions = $actions;

        return $this;
    }

    public function getCompetences(): ?Competences
    {
        return $this->competences;
    }

    public function setCompetences(?Competences $competences): self
    {
        $this->competences = $competences;

        return $this;
    }
}
