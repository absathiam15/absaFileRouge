<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
 
/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * @ORM\Table(name="`apprenant`")
 * @ApiResource(
 * normalizationContext={"groups"={"read"}},
 * denormalizationContext={"groups"={"write"}},
 * attributes={"security"="is_granted('ROLE_ADMIn')",
 *             "security_message"="Vous n'avez pas access à cette Ressource"},
 * collectionOperations={
 *      "get_apprenants"={
 *          "method"="get",
 *          "path"="/apprenants"
 *        },
 * 
 *      "add_apprenant" = {
 *          "method" = "POST",
 *          "path" = "/apprenants"
 *      }
 *    }
 * )
 * 
 */
class Apprenant extends User
{
    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="apprenants")
     */
    private $promo;

    /**
     * @ORM\ManyToOne(targetEntity=ProfilSortie::class, inversedBy="apprenants")
     * 
     */
    private $profilSortie;

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getProfilSortie(): ?ProfilSortie
    {
        return $this->profilSortie;
    }

    public function setProfilSortie(?ProfilSortie $profilSortie): self
    {
        $this->profilSortie = $profilSortie;

        return $this;
    }
}
