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

    #[ORM\ManyToOne(inversedBy: 'classes')]
    private ?Trainings $Trainings = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column]
    private ?int $max_users = null;

    #[ORM\OneToMany(mappedBy: 'Class', targetEntity: Enrollments::class)]
    private Collection $enrollments;

    public function __construct()
    {
        $this->enrollments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrainings(): ?Trainings
    {
        return $this->Trainings;
    }

    public function setTrainings(?Trainings $Trainings): self
    {
        $this->Trainings = $Trainings;

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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getMaxUsers(): ?int
    {
        return $this->max_users;
    }

    public function setMaxUsers(int $max_users): self
    {
        $this->max_users = $max_users;

        return $this;
    }

    /**
     * @return Collection<int, Enrollments>
     */
    public function getEnrollments(): Collection
    {
        return $this->enrollments;
    }

    public function addEnrollment(Enrollments $enrollment): self
    {
        if (!$this->enrollments->contains($enrollment)) {
            $this->enrollments->add($enrollment);
            $enrollment->setClass($this);
        }

        return $this;
    }

    public function removeEnrollment(Enrollments $enrollment): self
    {
        if ($this->enrollments->removeElement($enrollment)) {
            // set the owning side to null (unless already changed)
            if ($enrollment->getClass() === $this) {
                $enrollment->setClass(null);
            }
        }

        return $this;
    }
}
