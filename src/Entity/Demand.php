<?php

namespace App\Entity;

use App\Repository\DemandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandRepository::class)]
class Demand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'demands')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $emp_no = null;

    #[ORM\Column(length: 30)]
    private ?string $type = null;

    #[ORM\Column(length: 10)]
    private ?string $about = null;

    #[ORM\Column(length: 30)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmpNo(): ?Employee
    {
        return $this->emp_no;
    }

    public function setEmpNo(?Employee $emp_no): static
    {
        $this->emp_no = $emp_no;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(string $about): static
    {
        $this->about = $about;

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
}
