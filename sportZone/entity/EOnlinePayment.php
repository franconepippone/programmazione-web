<?php
use Doctrine\ORM\Mapping as ORM;

require_once("EPaymentMethod.php");

#[ORM\Entity]
#[ORM\Table(name: "pagamenti_online")]

class EOnlinePayment extends EPaymentMethod
{   
    // can only be bound to one credit card
    #[ORM\ManyToOne(targetEntity: ECreditCard::class, inversedBy: "onlinePayments", cascade: ["persist", "remove"])]
    private ECreditCard $creditCard;

    public function __construct() {
        parent::__construct();
    }

    public function setCreditCard(?ECreditCard $creditCard): self {
        $this->creditCard = $creditCard;
        return $this;
    }

    public function getCreditCard(): ECreditCard {
        return $this->creditCard;
    }
}