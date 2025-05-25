<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

require_once("Eutente.php");

#[ORM\Entity]
#[ORM\Table(name: "dipendenti")]

class EDipendente extends EUtente
{
    #[ORM\Column(type: "float")]
    private float $stipendio;

    #[ORM\OneToMany(mappedBy: "dipendente", targetEntity: EPagamento::class, cascade: ["persist", "remove"])]
    private Collection $pagamenti;

    #[ORM\ManyToMany(targetEntity: ECorso::class, inversedBy: "dipendenti")]
    #[ORM\JoinTable(name: "dipendenti_corsi")]
    private Collection $corsi;

    public function __construct() {
        parent::__construct();
        $this->pagamenti = new ArrayCollection();
        $this->corsi = new ArrayCollection();
    }

    public function getStipendio(): float {
        return $this->stipendio;
    }

    public function setStipendio(float $stipendio): void {
        $this->stipendio = $stipendio;
    }

    public function getPagamenti(): Collection {
        return $this->pagamenti;
    }

    public function addPagamento(EPagamento $pagamento): self {
        if (!$this->pagamenti->contains($pagamento)) {
            $this->pagamenti[] = $pagamento;
            $pagamento->setDipendente($this);
        }
        return $this;
    }

    public function removePagamento(EPagamento $pagamento): self {
        if ($this->pagamenti->removeElement($pagamento)) {
            $pagamento->setDipendente(null);
        }
        return $this;
    }

    public function getCorsi(): Collection {
        return $this->corsi;
    }

    public function addCorso(ECorso $corso): self {
        if (!$this->corsi->contains($corso)) {
            $this->corsi[] = $corso;
            $corso->addDipendente($this); // mantiene sincronizzazione
        }
        return $this;
    }

    public function removeCorso(ECorso $corso): self {
        if ($this->corsi->removeElement($corso)) {
            $corso->removeDipendente($this);
        }
        return $this;
    }
}