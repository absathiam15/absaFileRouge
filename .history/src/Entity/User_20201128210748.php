<?php

namespace App\Entity;

use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"admin" = "Admin", "apprenant" = "Apprenant", "formateur" = "Formateur", "cm" = "Cm", "user" = "User"})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * 
 * @ApiResource(
 * normalizationContext={"groups"={"read"}},
 * denormalizationContext={"groups"={"write"}},
 * attributes={"security"="is_granted('ROLE_ADMIN')",
 *             "security_message"="Vous n'avez pas access à cette Ressource"},
 * routePrefix = "/admin",
 * collectionOperations={
 *      "get_admin_user" = {
 *          "method" = "GET",
 *          "path" = "/users"
 *          },
 *      "add_user" = {
 *          "method" = "POST",
 *          "path" = "/users",
 *          "name" = "addUser",
 *          "deserialize" = false
 *          }
 *      },
 * itemOperations={
 *      "delete",
 *      "get_admin_user" = {
 *          "method" = "GET",
 *          "path" = "/users/{id}"
 *        },
 *      "update_user" = {
 *            "method" = "PUT",
 *            "path" = "/users/{id}",
 *            "name" = "updateUser"
 *         }    
 *    }
 * 
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"write", "read", "format:read"})
     */
    protected $username;

    
    protected $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write", "format:read"})
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write", "format:read"})
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write", "format:read"})
     */
    protected $genre;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"user:read", "write", "format:read"})
     */
    protected $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write", "format:read"})
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read","write", "format:read"})
     */
    protected $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @Groups({"read", "format:read"})
     */
    protected $profil;

    /**
     * @ORM\ManyToOne(targetEntity=Statut::class, inversedBy="users")
     * @Groups({"read", "write", "format:read"})
     */
    protected $statut;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"read", "write", "format:read"})
     */
    protected $isDeleted = 0;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    protected $avatar;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): self
    {
        $this->statut = $statut;

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

    public function getAvatar()
    {
        if ($this->avatar != null) {
            return \base64_encode(stream_get_contents($this->avatar));
        }
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

}
