<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Enum\UserSex;


require_once __DIR__ . "/../../vendor/autoload.php";

#[ORM\Entity]
#[ORM\Table(name: "clients")]
class EClient extends EUser
{
    #[ORM\OneToMany(mappedBy: "clients", targetEntity: EEnrollment::class, cascade: ["persist", "remove"])]
    private Collection $enrollments;

    #[ORM\OneToMany(mappedBy: "client", targetEntity: EPaymentMethod::class, cascade: ["persist", "remove"])]
    private Collection $paymentMethods;

    public function __construct() {
        $this->enrollments = new ArrayCollection();
    }

    public function getPaymentMethods(): Collection {
        return $this->paymentMethods;
    }

    public function addPaymentMethod(EPaymentMethod $paymentmethod): self {
        if (!$this->paymentMethods->contains($paymentmethod)) {
            $this->paymentMethods[] = $paymentmethod;
            $paymentmethod->setClient($this);
        }
        return $this;
    }

    public function removePaymentMethod(EPaymentMethod $paymentmethod): self {
        if ($this->paymentMethods->removeElement($paymentmethod)) {
            $paymentmethod->setClient(null);
        }
        return $this;
    }

    // ISCRIZIONI
    public function getEnrollments(): Collection {
        return $this->enrollments;
    }

    public function addEnrollment(EEnrollment $enrollment): self {
        if (!$this->enrollments->contains($enrollment)) {
            $this->enrollments[] = $enrollment;
            $enrollment->setClient($this);
        }
        return $this;
    }

    public function removeEnrollment(EEnrollment $enrollment): self {
        if ($this->enrollments->removeElement($enrollment)) {
            $enrollment->setClient(null);
        }
        return $this;
    }

    
    
    public static function clientToArray(EClient $client): array {
        return EUser::userToArray($client);
    }
}