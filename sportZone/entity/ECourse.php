<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "courses")]

class ECourse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $title;

    #[ORM\Column(type: "date")]
    private \DateTime $startDate;

    #[ORM\Column(type: "date")]
    private \DateTime $endDate;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 50)]
    private string $timeSlot;

    #[ORM\Column(type: "json")]
    private array $daysOfWeek = [];

    #[ORM\Column(type: "float")]
    private float $cost;

    #[ORM\Column(type: "integer")]
    private int $MaxParticipantsCount;

    // ======= RELAZIONI =======

    #[ORM\ManyToOne(targetEntity: EInstructor::class, inversedBy: "courses")]
    private ?EInstructor $instructor = null;

    #[ORM\ManyToMany(targetEntity: EEmployee::class, mappedBy: "courses")]
    private Collection $employees;

    #[ORM\ManyToOne(targetEntity: EField::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?EField $field = null;

    #[ORM\OneToMany(mappedBy: "course", targetEntity: EEnrollment::class, cascade: ["persist", "remove"])]
    private Collection $enrollments;

    public function __construct() {
        $this->employees = new ArrayCollection();
        $this->enrollments = new ArrayCollection();
    }

    // ========= GETTERS & SETTERS ==========

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getStartDate(): \DateTime {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $date): void {
        $this->startDate = $date;
    }

    public function getEndDate(): \DateTime {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $date): void {
        $this->endDate = $date;
    }

    public function getDaysOfWeek(): array {
        return $this->daysOfWeek;
    }

    public function setDaysOfWeek(array $days): void {
        $this->daysOfWeek = $days;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function getTimeSlot(): string {
        return $this->timeSlot;
    }

    public function setTimeSlot(string $timeslot): void {
        $this->timeSlot = $timeslot;
    }

    public function getEnrollmentCist(): float {
        return $this->cost;
    }

    public function setEnrollmentCost(float $cost): void {
        $this->cost = $cost;
    }

    public function getMaxParticipantsCount(): int {
        return $this->MaxParticipantsCount;
    }

    public function setMaxParticipantsCount(int $max): void {
        $this->MaxParticipantsCount = $max;
    }

    public function getInstructor(): ?EInstructor {
        return $this->instructor;
    }

    public function setInstructor(?EInstructor $instructor): void {
        $this->instructor = $instructor;
    }

    public function getEmployees(): Collection {
        return $this->employees;
    }

    public function addEmployee(EEmployee $employee): self {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
        }
        return $this;
    }

    public function removeEmployee(EEmployee $employee): self {
        $this->employees->removeElement($employee);
        return $this;
    }

    public function getField(): EField {
        return $this->field;
    }

    public function setField(?EField $field): void {
        $this->field = $field;
    }

    public function getEnrollments(): Collection {
        return $this->enrollments;
    }

    public function addEnrollment(EEnrollment $enrollment): self {
        if (!$this->enrollments->contains($enrollment)) {
            $this->enrollments->add($enrollment);
            $enrollment->setCourse($this); // sincronizza il lato inverso
        }
        return $this;
    }

    public function removeEnrollment(EEnrollment $enrollment): self {
        if ($this->enrollments->removeElement($enrollment)) {
            if ($enrollment->getCourse() === $this) {
                $enrollment->setCourse(null);
            }
        }
        return $this;
    }
}
