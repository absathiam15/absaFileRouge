<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupTagsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"grptags:read"}},
 * 
 * collectionOperations={
 *      "get_groupTags"={
 *          "method"="get",
 *          "path"="/admin/grptags"
 *        },
 *      "add_groupTags" = {
 *          "method" = "POST",
 *          "path" = "/admin/grptags"
 *         }
 *     },
 * itemOperations={
 *      "aff_grptags" = {
 *          "method" = "GET",
 *          "path" = "/admin/grptags/{id}"
 *        },
 *        "aff_tags_grptags" = {
    *         "method" = "GET",
    *         "path" = "/admin/grptags/{id}/tags"
 *        },
 *        "modif_grptags" = {
 *              "method" = "PUT",
 *              "path" = "/admin/grptags/{id}"
 *        }
 *      }
 * )
 * @ORM\Entity(repositoryClass=GroupTagsRepository::class)
 */
class GroupTags
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"grptags:read", "tags:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grptags:read", "tags:read"})
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Tags::class, mappedBy="groupTags")
     * @Groups({"grptags:read", "tags:read"})
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
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
     * @return Collection|Tags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addGroupTag($this);
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeGroupTag($this);
        }

        return $this;
    }
}
