<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    private ?Trainings $training_id = null;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    private ?Users $instructor_id = null;

    #[ORM\ManyToMany(targetEntity: Users::class, inversedBy: 'classes')]
    private Collection $enrollments;

    public function __construct()
    {
        $this->enrollments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTrainingId(): ?Trainings
    {
        return $this->training_id;
    }

    public function setTrainingId(?Trainings $training_id): self
    {
        $this->training_id = $training_id;

        return $this;
    }

    public function getInstructorId(): ?Users
    {
        return $this->instructor_id;
    }

    public function setInstructorId(?Users $instructor_id): self
    {
        $this->instructor_id = $instructor_id;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getEnrollments(): Collection
    {
        return $this->enrollments;
    }

    public function addEnrollment(Users $enrollment): self
    {
        if (!$this->enrollments->contains($enrollment)) {
            $this->enrollments->add($enrollment);
        }

        return $this;
    }

    public function removeEnrollment(Users $enrollment): self
    {
        $this->enrollments->removeElement($enrollment);

        return $this;
    }
}
