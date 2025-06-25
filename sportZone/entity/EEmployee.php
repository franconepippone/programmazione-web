<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

require_once("EUser.php");

#[ORM\Entity]
#[ORM\Table(name: "employees")]

class EEmployee extends EUser
{
    #[ORM\Column(type: "float")]
    private float $salary;

    #[ORM\ManyToMany(targetEntity: ECourse::class, inversedBy: "employees")]
    private Collection $courses;

    public function __construct() {
        parent::__construct();
        $this->paymentMethods = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    public function getSalary(): float {
        return $this->salary;
    }

    public function setSalary(float $salary): void {
        $this->salary = $salary;
    }

    public function getCourses(): Collection {
        return $this->courses;
    }

    public function addCourse(ECourse $course): self {
        if (!$this->courses->contains($course)) {
            $this->courses[] = $course;
            $course->addEmployee($this); // mantiene sincronizzazione
        }
        return $this;
    }

    public function removeCourse(ECourse $course): self {
        if ($this->courses->removeElement($course)) {
            $course->removeEmployee($this);
        }
        return $this;
    }
}
