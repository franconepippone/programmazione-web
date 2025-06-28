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
    
    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: "paymentMethods")]
    protected ?EClient $client = null;

    public function getId(): int {
        return $this->id;
    }
    
    public function getReservation(): ?EReservation {
        return $this->reservation;
    }

    public function setReservation(?EReservation $reservation): self {
        $this->reservation = $reservation;
        return $this;
    }

    

    public function getClient(): ?EClient {
        return $this->client;
    }

    public function setClient(?EClient $client): self {
        $this->client = $client;
        return $this;
    }
    
    public function pay(int $amountCents): bool {
        // This method should be implemented by subclasses
        return false;
    }

    public function getType(): string {
        return match (get_class($this)) {
            EOnlinePayment::class => 'online',
            EOnSitePayment::class => 'onsite',
            default => 'unknown',
            };
    }
}
