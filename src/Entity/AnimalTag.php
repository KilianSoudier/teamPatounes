<?php

namespace App\Entity;

use App\Repository\AnimalTagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalTagRepository::class)]
#[ORM\Table(
    name: 'animal_tag',
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_animal_tag_pair', columns: ['animal_id', 'tag_id']),
    ],
    indexes: [
        new ORM\Index(name: 'idx_animaltag_animal', columns: ['animal_id']),
        new ORM\Index(name: 'idx_animaltag_tag', columns: ['tag_id']),
    ]
)]
class AnimalTag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tags')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Animal $animal = null;

    #[ORM\ManyToOne(inversedBy: 'animalTags')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Tag $tag = null;

    public function getId(): ?int { return $this->id; }

    public function getAnimal(): ?Animal { return $this->animal; }
    public function setAnimal(?Animal $animal): static { $this->animal = $animal; return $this; }

    public function getTag(): ?Tag { return $this->tag; }
    public function setTag(?Tag $tag): static { $this->tag = $tag; return $this; }
}
