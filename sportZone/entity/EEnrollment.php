<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "enrollments")]

class EEnrollment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "date")]
    private \DateTime $enrollmentDate; //include anche orario

    // ======= RELAZIONI =======

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: "courses")]
    private ?EClient $client = null;

    #[ORM\OneToOne(targetEntity: ECourse::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ECourse $course = null;

    // ========= GETTERS & SETTERS ==========

    public function getId(): int {
        return $this->id;
    }

    public function getEnrollmentDate(): \DateTime {
        return $this->enrollmentDate;
    }

    public function setEnrollmentDate(\DateTime $data): void {
        $this->enrollmentDate = $data;
    }

    public function getClient(): ?EClient {
        return $this->client;
    }

    public function setClient(?EClient $client): void {
        $this->client = $client;
    }

    public function getCourse(): ?ECourse {
        return $this->course;
    }

    public function setCourse(?ECourse $course): void {
        $this->course = $course;
    }

    public static function enrollmentToArray(EEnrollment $enrollment): array {
        return [
            'id' => $enrollment->getId(),
            'enrollmentDate' => $enrollment->getEnrollmentDate()->format('Y-m-d H:i:s'),
            'client' => $enrollment->getClient() ? EClient::clientToArray($enrollment->getClient()) : null,
            'course' => $enrollment->getCourse() ? ECourse::courseToArray($enrollment->getCourse()) : null,
        ];
    }

    public function __construct(){}
}

