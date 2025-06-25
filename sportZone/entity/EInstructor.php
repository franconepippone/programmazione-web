<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

require_once("EUser.php");

#[ORM\Entity]
#[ORM\Table(name: "instructors")]

class EInstructor extends EUser
{
    #[ORM\Column(type: "text", nullable: true)]
    private ?string $cv = null;

    #[ORM\OneToMany(mappedBy: "instructor", targetEntity: ECourse::class, cascade: ["persist", "remove"])]
    private Collection $courses;

    public function __construct() {
        parent::__construct();
        $this->courses = new ArrayCollection();
    }

    public function getCv(): ?string {
        return $this->cv;
    }

    public function setCv(?string $cv): void {
        $this->cv = $cv;
    }

    public function getCourses(): Collection {
        return $this->courses;
    }

    public function addCourse(ECourse $course): self {
        if (!$this->courses->contains($course)) {
            $this->courses[] = $course;
            $course->setInstructor($this);
        }
        return $this;
    }

    public function removeCourse(ECourse $course): self {
        if ($this->courses->removeElement($course)) {
            $course->setInstructor(null);
        }
        return $this;
    }
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream

    public static function instructorToArray(EInstructor $inst) {
        return [
            'id' => $inst->getId(),
            'name' => $inst->getName(),
            'surname' => $inst->getSurname()
        ];
    }
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    public static function instructorToArray(EInstructor $instructor): array {
    // Ottieni i nomi dei corsi
    $courses = [];
    foreach ($instructor->getCourses() as $course) {
        if (method_exists($course, 'getTitle')) {
            $courses[] = $course->getTitle();
        }
    }

    return [
        'id' => $instructor->getId(),
        'name' => $instructor->getName(),
        'surname' => $instructor->getSurname(),
        'email' => $instructor->getEmail(),
        'cv' => $instructor->getCv(),
        'courses' => $courses,
        // aggiungi altri dati se necessario
    ];
}
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
}