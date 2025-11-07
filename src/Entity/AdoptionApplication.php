<?php

namespace App\Entity;

use App\Repository\AdoptionApplicationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdoptionApplicationRepository::class)]
#[ORM\Table(
    name: 'adoption_application',
    indexes: [
        new ORM\Index(name: 'idx_app_status', columns: ['status']),
        new ORM\Index(name: 'idx_app_created_at', columns: ['created_at']),
        new ORM\Index(name: 'idx_app_applicant', columns: ['applicant_id']),
        new ORM\Index(name: 'idx_app_animal', columns: ['animal_id']),
    ]
)]
#[ORM\HasLifecycleCallbacks]
class AdoptionApplication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(length: 12)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $processedAt = null;

    #[ORM\ManyToOne(inversedBy: 'adoptionApplications')]
    private ?User $applicant = null;

    #[ORM\ManyToOne(inversedBy: 'adoptionApplications')]
    private ?Animal $animal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
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

    public function getProcessedAt(): ?\DateTime
    {
        return $this->processedAt;
    }

    public function setProcessedAt(?\DateTime $processedAt): static
    {
        $this->processedAt = $processedAt;

        return $this;
    }

    public function getApplicant(): ?User
    {
        return $this->applicant;
    }

    public function setApplicant(?User $applicant): static
    {
        $this->applicant = $applicant;

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
