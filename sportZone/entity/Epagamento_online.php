<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

require_once("Epagamento.php");

#[ORM\Entity]
class PagamentoOnline extends Pagamento
{
    #[ORM\OneToMany(targetEntity: CartaDiCredito::class, mappedBy: "pagamentoOnline", cascade: ["persist", "remove"])]
    private Collection $carteDiCredito;

    public function __construct() {
        parent::__construct();
        $this->carteDiCredito = new ArrayCollection();
    }

    /**
     * @return Collection|CartaDiCredito[]
     */
    public function getCarteDiCredito(): Collection {
        return $this->carteDiCredito;
    }

    public function addCartaDiCredito(CartaDiCredito $carta): self {
        if (!$this->carteDiCredito->contains($carta)) {
            $this->carteDiCredito->add($carta);
            $carta->setPagamentoOnline($this);
        }
        return $this;
    }

    public function removeCartaDiCredito(CartaDiCredito $carta): self {
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