<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\AnimalSex;
use App\Enum\AnimalSize;
use App\Enum\AnimalStatus;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ORM\Table(
    name: 'animal',
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_animal_slug', columns: ['slug']),
    ],
    indexes: [
        new ORM\Index(name: 'idx_animal_status', columns: ['status']),
        new ORM\Index(name: 'idx_animal_size', columns: ['size']),
        new ORM\Index(name: 'idx_animal_sex', columns: ['sex']),
        new ORM\Index(name: 'idx_animal_created_at', columns: ['created_at']),
        new ORM\Index(name: 'idx_animal_shelter', columns: ['shelter_id']),
        new ORM\Index(name: 'idx_animal_species', columns: ['species_id']),
        new ORM\Index(name: 'idx_animal_breed', columns: ['breed_id']),
    ]
)]
#[ORM\HasLifecycleCallbacks]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $name = null;

    #[ORM\Column(length: 160)]
    private ?string $slug = null;

    #[ORM\Column(enumType: AnimalSex::class)]
    private ?AnimalSex $sex = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $birthDate = null;

    #[ORM\Column(enumType: AnimalSize::class, nullable: true)]
    private ?AnimalSize $size = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(enumType: AnimalStatus::class)]
    private ?AnimalStatus $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTime $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coverPath = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shelter $shelter = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Species $species = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Breed $breed = null;

    /**
     * @var Collection<int, AnimalPhoto>
     */
    #[ORM\OneToMany(targetEntity: AnimalPhoto::class, mappedBy: 'animal')]
    private Collection $photos;

    /**
     * @var Collection<int, AnimalTag>
     */
    #[ORM\OneToMany(targetEntity: AnimalTag::class, mappedBy: 'animal', orphanRemoval: true, cascade: ['persist','remove'])]
    private Collection $tags;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?MedicalRecord $medicalRecord = null;

    /**
     * @var Collection<int, AdoptionApplication>
     */
    #[ORM\OneToMany(targetEntity: AdoptionApplication::class, mappedBy: 'animal')]
    private Collection $adoptionApplications;

    /**
     * @var Collection<int, Favorite>
     */
    #[ORM\OneToMany(targetEntity: Favorite::class, mappedBy: 'animal')]
    private Collection $favorites;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->adoptionApplications = new ArrayCollection();
        $this->favorites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(AnimalSex $sex): static
    {
        $this->sex = $sex;

        return $this;
    }

    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTime $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?AnimalSize $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(AnimalStatus $status): static
    {
        $this->status = $status;

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

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCoverPath(): ?string
    {
        return $this->coverPath;
    }

    public function setCoverPath(?string $coverPath): static
    {
        $this->coverPath = $coverPath;

        return $this;
    }

    public function getShelter(): ?Shelter
    {
        return $this->shelter;
    }

    public function setShelter(?Shelter $shelter): static
    {
        $this->shelter = $shelter;

        return $this;
    }

    public function getSpecies(): ?Species
    {
        return $this->species;
    }

    public function setSpecies(?Species $species): static
    {
        $this->species = $species;

        return $this;
    }

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): static
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * @return Collection<int, AnimalPhoto>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(AnimalPhoto $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setAnimal($this);
        }

        return $this;
    }

    public function removePhoto(AnimalPhoto $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getAnimal() === $this) {
                $photo->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AnimalTag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(AnimalTag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(AnimalTag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getMedicalRecord(): ?MedicalRecord
    {
        return $this->medicalRecord;
    }

    public function setMedicalRecord(?MedicalRecord $medicalRecord): static
    {
        $this->medicalRecord = $medicalRecord;

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
            $adoptionApplication->setAnimal($this);
        }

        return $this;
    }

    public function removeAdoptionApplication(AdoptionApplication $adoptionApplication): static
    {
        if ($this->adoptionApplications->removeElement($adoptionApplication)) {
            // set the owning side to null (unless already changed)
            if ($adoptionApplication->getAnimal() === $this) {
                $adoptionApplication->setAnimal(null);
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
            $favorite->setAnimal($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): static
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getAnimal() === $this) {
                $favorite->setAnimal(null);
            }
        }

        return $this;
    }
}
