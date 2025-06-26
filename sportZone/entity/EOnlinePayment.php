<?php
use Doctrine\ORM\Mapping as ORM;

require_once("EPaymentMethod.php");

#[ORM\Entity]
#[ORM\Table(name: "online_payments")]

class EOnlinePayment extends EPaymentMethod
{   
    // can only be bound to one credit card
    #[ORM\ManyToOne(targetEntity: ECreditCard::class, inversedBy: "onlinePayments", cascade: ["persist", "remove"])]
    private ECreditCard $creditCard;

    public function setCreditCard(?ECreditCard $creditCard): self {
        $this->creditCard = $creditCard;
        return $this;
    }

    public function getCreditCard(): ECreditCard {
        return $this->creditCard;
    }

    public function pay(int $amountCents): bool {
        // Here you would implement the logic to process the payment using the credit card
        // For now, we will just simulate a successful payment
        if ($this->creditCard) {
            // Simulate payment processing
            return true; // Payment successful
        }
        return false; // Payment failed, no credit card set
    }
}