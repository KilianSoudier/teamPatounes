<?php

namespace App\Entity;

use App\Repository\MedicalRecordRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicalRecordRepository::class)]
#[ORM\Table(
    name: 'medical_record',
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_medical_animal', columns: ['animal_id']),
    ],
    indexes: [
        new ORM\Index(name: 'idx_medical_last_visit', columns: ['last_vet_visit_at']),
    ]
)]
class MedicalRecord
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $vaccinated = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $chipped = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $sterilized = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $lastVetVisitAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Animal $animal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isVaccinated(): ?bool
    {
        return $this->vaccinated;
    }

    public function setVaccinated(bool $vaccinated): static
    {
        $this->vaccinated = $vaccinated;

        return $this;
    }

    public function isChipped(): ?bool
    {
        return $this->chipped;
    }

    public function setChipped(bool $chipped): static
    {
        $this->chipped = $chipped;

        return $this;
    }

    public function isSterilized(): ?bool
    {
        return $this->sterilized;
    }

    public function setSterilized(bool $sterilized): static
    {
        $this->sterilized = $sterilized;

        return $this;
    }

    public function getLastVetVisitAt(): ?\DateTime
    {
        return $this->lastVetVisitAt;
    }

    public function setLastVetVisitAt(?\DateTime $lastVetVisitAt): static
    {
        $this->lastVetVisitAt = $lastVetVisitAt;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }
}
