<?php

namespace App\Entity;

use App\Repository\SalaryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalaryRepository::class)]
#[ORM\Table('salaries')]
class Salary
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'salaries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $emp_no = null;

    #[ORM\Column]
    private ?int $salary = null;

    #[ORM\Id]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $from_date = null;

    public function getEmpNo(): ?Employee
    {
        return $this->emp_no;
    }

    public function setEmpNo(?Employee $emp_no): static
    {
        $this->emp_no = $emp_no;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): static
    {
        $this->salary = $salary;

        return $this;
    }

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->from_date;
    }

    public function setFromDate(\DateTimeInterface $from_date): static
    {
        $this->from_date = $from_date;

        return $this;
    }
}
