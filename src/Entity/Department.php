<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $dept_name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addres = null;

    #[ORM\Column(length: 255)]
    private ?string $roi_url = null;

    /**
     * @var Collection<int, Employee>
     */
    #[ORM\ManyToMany(targetEntity: Employee::class, inversedBy: 'departments')]
    private Collection $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeptName(): ?string
    {
        return $this->dept_name;
    }

    public function setDeptName(string $dept_name): static
    {
        $this->dept_name = $dept_name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAddres(): ?string
    {
        return $this->addres;
    }

    public function setAddres(?string $addres): static
    {
        $this->addres = $addres;

        return $this;
    }

    public function getRoiUrl(): ?string
    {
        return $this->roi_url;
    }

    public function setRoiUrl(string $roi_url): static
    {
        $this->roi_url = $roi_url;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): static
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): static
    {
        $this->employees->removeElement($employee);

        return $this;
    }
}
