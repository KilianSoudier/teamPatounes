<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(
    name: 'user',
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_user_email', columns: ['email']),
    ],
    indexes: [
        new ORM\Index(name: 'idx_user_fullname', columns: ['fullname']),
    ]
)]
#[ORM\HasLifecycleCallbacks]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 100)]
    private ?string $fullname = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Shelter>
     */
    #[ORM\OneToMany(targetEntity: Shelter::class, mappedBy: 'manager')]
    private Collection $managedShelters;

    /**
     * @var Collection<int, AdoptionApplication>
     */
    #[ORM\OneToMany(targetEntity: AdoptionApplication::class, mappedBy: 'applicant')]
    private Collection $adoptionApplications;

    /**
     * @var Collection<int, Favorite>
     */
    #[ORM\OneToMany(targetEntity: Favorite::class, mappedBy: 'user')]
    private Collection $favorites;

    public function __construct()
    {
        $this->managedShelters = new ArrayCollection();
        $this->adoptionApplications = new ArrayCollection();
        $this->favorites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): static
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Shelter>
     */
    public function getManagedShelters(): Collection
    {
        return $this->managedShelters;
    }

    public function addManagedShelter(Shelter $managedShelter): static
    {
        if (!$this->managedShelters->contains($managedShelter)) {
            $this->managedShelters->add($managedShelter);
            $managedShelter->setManager($this);
        }

        return $this;
    }

    public function removeManagedShelter(Shelter $managedShelter): static
    {
        if ($this->managedShelters->removeElement($managedShelter)) {
            // set the owning side to null (unless already changed)
            if ($managedShelter->getManager() === $this) {
                $managedShelter->setManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AdoptionApplication>
     */
    public function getAdoptionApplications(): Collection
    {
        return $this->adoptionApplications;
    }

    public function addAdoptionApplication(AdoptionApplication $adoptionApplication): static
    {
        if (!$this->adoptionApplications->contains($adoptionApplication)) {
            $this->adoptionApplications->add($adoptionApplication);
            $adoptionApplication->setApplicant($this);
        }

        return $this;
    }

    public function removeAdoptionApplication(AdoptionApplication $adoptionApplication): static
    {
        if ($this->adoptionApplications->removeElement($adoptionApplication)) {
            // set the owning side to null (unless already changed)
            if ($adoptionApplication->getApplicant() === $this) {
                $adoptionApplication->setApplicant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Favorite>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorite $favorite): static
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setUser($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getUser() === $this) {
                $favorite->setUser(null);
            }
        }

        return $this;
    }
}
