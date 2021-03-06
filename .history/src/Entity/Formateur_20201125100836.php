<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ORM\Table(name="`formateur`")
 */
class Formateur extends User
{
    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted;

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
