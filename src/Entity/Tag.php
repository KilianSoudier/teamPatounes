<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ORM\Table(
    name: 'tag',
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_tag_name', columns: ['name']),
        new ORM\UniqueConstraint(name: 'uniq_tag_slug', columns: ['slug']),
    ],
    indexes: [
        new ORM\Index(name: 'idx_tag_name', columns: ['name']),
        new ORM\Index(name: 'idx_tag_slug', columns: ['slug']),
    ]
)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $name = null;

    #[ORM\Column(length: 120)]
    private ?string $slug = null;

    /**
     * @var Collection<int, AnimalTag>
     */
    #[ORM\OneToMany(targetEntity: AnimalTag::class, mappedBy: 'tag', orphanRemoval: true, cascade: ['remove'])]
    private Collection $animalTags;

    public function __construct()
    {
        $this->animalTags = new ArrayCollection();
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

    /**
     * @return Collection<int, AnimalTag>
     */
    public function getAnimalTags(): Collection
    {
        return $this->animalTags;
    }

    public function addAnimalTag(AnimalTag $animalTag): static
    {
        if (!$this->animalTags->contains($animalTag)) {
            $this->animalTags->add($animalTag);
            $animalTag->setTag($this);
        }

        return $this;
    }

    public function removeAnimalTag(AnimalTag $animalTag): static
    {
        if ($this->animalTags->removeElement($animalTag)) {
            // set the owning side to null (unless already changed)
            if ($animalTag->getTag() === $this) {
                $animalTag->setTag(null);
            }
        }

        return $this;
    }
}
