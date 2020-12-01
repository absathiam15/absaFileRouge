<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"grptags:read"}},
)
 * @ORM\Entity(repositoryClass=TagsRepository::class)
 */
class Tags
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"grptags:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grptags:read"})
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=GroupTags::class, inversedBy="tags")
     */
    private $groupTags;

    public function __construct()
    {
        $this->groupTags = new ArrayCollection();
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
     * @return Collection|GroupTags[]
     */
    public function getGroupTags(): Collection
    {
        return $this->groupTags;
    }

    public function addGroupTag(GroupTags $groupTag): self
    {
        if (!$this->groupTags->contains($groupTag)) {
            $this->groupTags[] = $groupTag;
        }

        return $this;
    }

    public function removeGroupTag(GroupTags $groupTag): self
    {
        $this->groupTags->removeElement($groupTag);

        return $this;
    }
}
