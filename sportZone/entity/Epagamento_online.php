<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

require_once("Epagamento.php");

#[ORM\Entity]
#[ORM\Table(name: "pagamenti_online")]

class EPagamentoOnline extends EPagamento
{
    #[ORM\OneToMany(targetEntity: ECartaDiCredito::class, mappedBy: "pagamentoOnline", cascade: ["persist", "remove"])]
    private Collection $carteDiCredito;

    public function __construct() {
        parent::__construct();
        $this->carteDiCredito = new ArrayCollection();
    }

    /**
     * @return Collection|ECartaDiCredito[]
     */
    public function getCarteDiCredito(): Collection {
        return $this->carteDiCredito;
    }

    public function addCartaDiCredito(ECartaDiCredito $carta): self {
        if (!$this->carteDiCredito->contains($carta)) {
            $this->carteDiCredito->add($carta);
            $carta->setPagamentoOnline($this);
        }
        return $this;
    }

    public function removeCartaDiCredito(ECartaDiCredito $carta): self {
        if ($this->carteDiCredito->contains($carta)) {
            $this->carteDiCredito->removeElement($carta);
            // Rimuovi il collegamento inverso
            if ($carta->getPagamentoOnline() === $this) {
                $carta->setPagamentoOnline(null);
            }
        }
        return $this;
    }
}