<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PromoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PromoRepository::class)
 */
class Promo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $annee;

    /**
     * @ORM\Column(type="date")
     */
    private $debut;

    /**
     * @ORM\Column(type="date")
     */
    private $fin;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $lieuPromo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $choixFabrique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $effectifEntrant;

    /**
     * @ORM\Column(type="integer")
     */
    private $effectifSortant;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="promo")
     */
    private $apprenants;

    /**
     * @ORM\ManyToMany(targetEntity=Langue::class, inversedBy="promos")
     */
    private $langue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="promo")
     */
    private $groupes;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
        $this->langue = new ArrayCollection();
        $this->groupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getLieuPromo(): ?string
    {
        return $this->lieuPromo;
    }

    public function setLieuPromo(string $lieuPromo): self
    {
        $this->lieuPromo = $lieuPromo;

        return $this;
    }

    public function getChoixFabrique(): ?string
    {
        return $this->choixFabrique;
    }

    public function setChoixFabrique(string $choixFabrique): self
    {
        $this->choixFabrique = $choixFabrique;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getEffectifEntrant(): ?int
    {
        return $this->effectifEntrant;
    }

    public function setEffectifEntrant(int $effectifEntrant): self
    {
        $this->effectifEntrant = $effectifEntrant;

        return $this;
    }

    public function getEffectifSortant(): ?int
    {
        return $this->effectifSortant;
    }

    public function setEffectifSortant(int $effectifSortant): self
    {
        $this->effectifSortant = $effectifSortant;

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
            $apprenant->setPromo($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getPromo() === $this) {
                $apprenant->setPromo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Langue[]
     */
    public function getLangue(): Collection
    {
        return $this->langue;
    }

    public function addLangue(Langue $langue): self
    {
        if (!$this->langue->contains($langue)) {
            $this->langue[] = $langue;
        }

        return $this;
    }

    public function removeLangue(Langue $langue): self
    {
        $this->langue->removeElement($langue);

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
            $groupe->setPromo($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getPromo() === $this) {
                $groupe->setPromo(null);
            }
        }

        return $this;
    }

}
