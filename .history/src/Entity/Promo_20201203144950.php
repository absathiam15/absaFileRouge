<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/** 
 * @ORM\Entity(repositoryClass=PromoRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"promo:read"}},
 * denormalizationContext={"groups"={"promo:write"}},
 * collectionOperations={
 *      "add_promo"={
 *          "method"="POST",
 *          "path"="/admin/promo"
 *        }
 *   },
 * itemOperations={
 *      "get_promo"={
 *          "method"="GET",
 *          "path"="/admin/promo"
 *        }
 *   }
 * 
 * )
 */
class Promo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"promo:write", "group:read", "promo:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"promo:write", "promo:read"})
     * 
     */
    private $annee;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"promo:write", "promo:read"})
     * 
     */
    private $debut;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"promo:write", "promo:read"})
     * 
     */
    private $fin;

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups({"groupe:write", "group:read", "promo:write", "promo:read"})
     */
    private $lieuPromo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"groupe:write", "group:read", "promo:write", "promo:read"})
     */
    private $choixFabrique;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"groupe:write", "group:read", "promo:write", "promo:read"})
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"groupe:write", "group:read", "promo:write", "promo:read"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"groupe:write", "group:read", "promo:write", "promo:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"groupe:write", "group:read", "promo:write", "promo:read"})
     */
    private $effectifEntrant;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"groupe:write", "group:read", "promo:write", "promo:read"})
     */
    private $effectifSortant;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="promo", cascade={"persist"})
     * @Groups({"groupe:write, "promo:write", "promo:read"})
     */
    private $apprenants;

    /**
     * @ORM\ManyToMany(targetEntity=Langue::class, inversedBy="promos")
     * @Groups({"groupe:write"})
     */
    private $langue;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"promo:write"})
     */
    private $isDeleted;

    /**
     * @ORM\ManyToMany(targetEntity=Referentiel::class, inversedBy="promos", cascade = {"Persist"})
     * @Groups({"groupe:write", "group:read", "promo:read"})
     */
    private $referentiel;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="promo")
     * 
     */
    private $groupe;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
        $this->langue = new ArrayCollection();
        $this->referentiel = new ArrayCollection();
        $this->groupe = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        $this->referentiel->removeElement($referentiel);

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe[] = $groupe;
            $groupe->setPromo($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupe->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getPromo() === $this) {
                $groupe->setPromo(null);
            }
        }

        return $this;
    }

}
