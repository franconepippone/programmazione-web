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

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: "reservations")]
    #[ORM\JoinColumn(nullable: false)]
    private EClient $client;

    #[ORM\OneToOne(targetEntity: EPaymentMethod::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    private EPaymentMethod $paymentMethod;

    public function __construct(
        \DateTimeInterface $date,
        \DateTimeInterface $time,
        EField $field,
        EClient $client,
        EPaymentMethod $paymentMethod
    ) {
        $this->date = $date;
        $this->time = $time;
        $this->field = $field;
        $this->client = $client;
        $this->paymentMethod = $paymentMethod;
    }

    // Getter e Setter

    public function getId(): int {
        return $this->id;
    }

    public function getData(): \DateTimeInterface {
        return $this->date;
    }

    public function setData(\DateTimeInterface $data): void {
        $this->date = $data;
    }

     public function getTime(): \DateTimeInterface {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $data): void {
        $this->time = $time;
    }

    public function getField(): EField {
        return $this->field;
    }

    public function setField(?EField $field): void {
        $this->field = $field;
    }

    public function getClient(): EClient {
        return $this->client;
    }

    public function setClient(?EClient $client): void {
        $this->client = $client;
    }

    public function getPaymentMethod(): EPaymentMethod {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(EPaymentMethod $paymentMethod): void {
        $this->paymentMethod = $paymentMethod;
    }

    public static function reservationToArray(EReservation $reservation) {
        
        return [
            'client_name' => $reservation->getClient() ? $reservation->getClient() -> getName() : null,
            'client_surname' => $reservation->getClient() ? $reservation->getClient() -> getSurname() : null,
            'id' => $reservation->getId(),
            'date' => $reservation->getDate(),
            'time' => $reservation->getTime(),
            'field' => $reservation->getField() ? $reservation->getField()->getName() : null,
            'sport' => $reservation->getField() ? $reservation->getField()->getSport() : null,
            'paymentMethod' => $reservation->getPaymentMethod() ? $reservation->get
            
            
        ];
    }
}
