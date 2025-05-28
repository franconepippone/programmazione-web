<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "credit_cards")]
class ECreditCard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 20)]
    private string $number;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $expirationDate;

    #[ORM\Column(type: "string", length: 50)]
    private string $cardNetwork;

    #[ORM\Column(type: "string", length: 50)]
    private string $bank;

    #[ORM\Column(type: "string", length: 100)]
    private string $owner;

    // Relazione molti a uno con OnlinePayment
    #[ORM\JoinColumn(nullable: false)]
    #[ORM\OneToMany(targetEntity: EOnlinePayment::class, mappedBy: "creditCard")]
    private Collection $onlinePayments;

    // Constructor
    public function __construct(
        int $number,
        \DateTimeInterface $expirationDate,
        string $cardNetwork,
        string $bank,
        string $owner
    ) {
        $this->number = $number;
        $this->expirationDate = $expirationDate;
        $this->cardNetwork = $cardNetwork;
        $this->bank = $bank;
        $this->owner = $owner;
        $this->onlinePayments = new ArrayCollection();
    }

    // Getters e setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function getExpirationDate(): \DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $expirationDate): self
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    public function getCardNetwork(): string
    {
        return $this->cardNetwork;
    }

    public function setCardNetwork(string $cardnetwork): self
    {
        $this->cardNetwork = $cardnetwork;
        return $this;
    }

    public function getBank(): string
    {
        return $this->bank;
    }

    public function setBank(string $bank): self
    {
        $this->bank = $bank;
        return $this;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    public function getOnlinePayments(): Collection {
        return $this->onlinePayments;
    }

    public function addOnlinePayment(EOnlinePayment $onlPayment): self {
        if (!$this->onlinePayments->contains($onlPayment)) {
            $this->onlinePayments[] = $onlPayment;
            $onlPayment->setCreditCard($this);
        }
        return $this;
    }

    public function removeOnlinePayment(EOnlinePayment $onlPayment): self {
        if ($this->onlinePayments->removeElement($onlPayment)) {
            $onlPayment->setCreditCard(null);
        }
        return $this;
    }
}