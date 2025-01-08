<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
#[ORM\Table('employees')]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'emp_no')]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birth_date = null;

    #[ORM\Column(length: 14)]
    private ?string $first_name = null;

    #[ORM\Column(length: 16)]
    private ?string $last_name = null;

    #[ORM\Column(length: 1)]
    #[Assert\Choice(
        choice:['M','F','X'],
        message:'Veuillez choisir le genre.'
    )]
    private ?string $gender = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $hire_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(
        message:'Email non valide.'
    )]
    private ?string $email = null;

    /**
     * @var Collection<int, Salary>
     */
    #[ORM\OneToMany(targetEntity: Salary::class, mappedBy: 'emp_no')]
    private Collection $salaries;

    /**
     * @var Collection<int, Demand>
     */
    #[ORM\OneToMany(targetEntity: Demand::class, mappedBy: 'emp_no', orphanRemoval: true)]
    private Collection $demands;

    /**
     * @var Collection<int, Department>
     */
    #[ORM\ManyToMany(targetEntity: Department::class, mappedBy: 'employees')]
    private Collection $departments;

    public function __construct()
    {
        $this->salaries = new ArrayCollection();
        $this->demands = new ArrayCollection();
        $this->departments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): static
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getHireDate(): ?\DateTimeInterface
    {
        return $this->hire_date;
    }

    public function setHireDate(\DateTimeInterface $hire_date): static
    {
        $this->hire_date = $hire_date;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Salary>
     */
    public function getSalaries(): Collection
    {
        return $this->salaries;
    }

    public function addSalary(Salary $salary): static
    {
        if (!$this->salaries->contains($salary)) {
            $this->salaries->add($salary);
            $salary->setEmpNo($this);
        }

        return $this;
    }

    public function removeSalary(Salary $salary): static
    {
        if ($this->salaries->removeElement($salary)) {
            // set the owning side to null (unless already changed)
            if ($salary->getEmpNo() === $this) {
                $salary->setEmpNo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Demand>
     */
    public function getDemands(): Collection
    {
        return $this->demands;
    }

    public function addDemand(Demand $demand): static
    {
        if (!$this->demands->contains($demand)) {
            $this->demands->add($demand);
            $demand->setEmpNo($this);
        }

        return $this;
    }

    public function removeDemand(Demand $demand): static
    {
        if ($this->demands->removeElement($demand)) {
            // set the owning side to null (unless already changed)
            if ($demand->getEmpNo() === $this) {
                $demand->setEmpNo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Department>
     */
    public function getDepartments(): Collection
    {
        return $this->departments;
    }

    public function addDepartment(Department $department): static
    {
        if (!$this->departments->contains($department)) {
            $this->departments->add($department);
            $department->addEmployee($this);
        }

        return $this;
    }

    public function removeDepartment(Department $department): static
    {
        if ($this->departments->removeElement($department)) {
            $department->removeEmployee($this);
        }

        return $this;
    }
}
