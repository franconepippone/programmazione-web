<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "reservations")]
class EReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $date;

    #[ORM\Column(type: "time")]
    private \DateTimeInterface $time;

    #[ORM\ManyToOne(targetEntity: EField::class, inversedBy: "reservations")]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private EField $field;

    #[ORM\ManyToOne(targetEntity: EUser::class, inversedBy: "reservations")]
    #[ORM\JoinColumn(nullable: false)]
    private EUser $user;

    #[ORM\OneToOne(targetEntity: EPaymentMethod::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    private EPaymentMethod $paymentMethod;

    public function __construct(
        \DateTimeInterface $date,
        \DateTimeInterface $time,
        EField $field,
        EUser $user,
        EPaymentMethod $paymentMethod
    ) {
        $this->date = $date;
        $this->time = $time;
        $this->field = $field;
        $this->user = $user;
        $this->paymentMethod = $paymentMethod;
    }

    // Getter e Setter

    public function getId(): int {
        return $this->id;
    }

    public function getDate(): \DateTimeInterface {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): void {
        $this->date = $date;
    }

     public function getTime(): \DateTimeInterface {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): void {
        $this->time = $time;
    }

    public function getField(): EField {
        return $this->field;
    }

    public function setField(?EField $field): void {
        $this->field = $field;
    }

    public function getUser(): EUser {
        return $this->user;
    }

    public function setUser(?EUser $user): void {
        $this->user = $user;
    }

    public function getPaymentMethod(): EPaymentMethod {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(EPaymentMethod $paymentMethod): void {
        $this->paymentMethod = $paymentMethod;
    }

    public static function reservationToArray(EReservation $reservation) {
        $user = $reservation->getUser();
        $field = $reservation->getField();

        return [
            'fullname' => $user ? $user->getName() . ' ' . $user->getSurname() : null,
            'id' => $reservation->getId(),
            'date' => $reservation->getDate() instanceof DateTimeInterface ? $reservation->getDate()->format('Y-m-d') : $reservation->getDate(),
            'time' => $reservation->getTime() instanceof DateTimeInterface ? $reservation->getTime()->format('H:i') : $reservation->getTime(),
            'field' => $field ? $field->getName() : null,
            'sport' => $field ? $field->getSport() : null,
            'cost' => $field ? $field->getCost() : null,
            'paymentMethod' => $reservation->getPaymentMethod() ? $reservation->getPaymentMethod()->getType() : null
        ];
    }
}
