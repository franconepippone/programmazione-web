<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "payment_type", type: "string")]
#[ORM\DiscriminatorMap(["online" => EOnlinePayment::class, "onsite" => EOnSitePayment::class])]
#[ORM\Table(name: "payment_methods")]
abstract class EPaymentMethod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected int $id;

    #[ORM\OneToOne(mappedBy: "paymentMethod", targetEntity: EReservation::class)]
    protected ?EReservation $reservation = null;

    #[ORM\OneToOne(mappedBy: "paymentMethod", targetEntity: EEnrollment::class)]
    protected ?EEnrollment $enrollment = null;

    #[ORM\ManyToOne(targetEntity: EEmployee::class, inversedBy: "paymentMethods")]
    protected ?EEmployee $employee = null;

    public function __construct() {}

    public function getId(): int {
        return $this->id;
    }
    
    public function getReservation(): ?EReservation {
        return $this->reservation;
    }

    public function setReservation(?EReservation $reservation): void {
        $this->reservation = $reservation;
    }

    public function getEnrollment(): ?EEnrollment {
        return $this->enrollment;
    }

    public function setEnrollment(?EEnrollment $enrollment): void {
        $this->enrollment = $enrollment;
    }

    public function getEmployee(): ?EEmployee {
        return $this->employee;
    }

    public function setEmployee(?EEmployee $employee): void {
        $this->employee = $employee;
    }
}