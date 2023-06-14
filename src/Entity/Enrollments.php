<?php

namespace App\Entity;

use App\Repository\EnrollmentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnrollmentsRepository::class)]
class Enrollments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'enrollments')]
    private ?Classes $Class = null;

    #[ORM\ManyToOne(inversedBy: 'enrollments')]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClass(): ?Classes
    {
        return $this->Class;
    }

    public function setClass(?Classes $Class): self
    {
        $this->Class = $Class;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
