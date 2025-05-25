<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

require_once("Eutente.php");

#[ORM\Entity]
#[ORM\Table(name: "clienti")]
class ECliente extends EUtente
{
    #[ORM\OneToMany(mappedBy: "cliente", targetEntity: EIscrizione::class, cascade: ["persist", "remove"])]
    private Collection $iscrizioni;

    #[ORM\OneToMany(mappedBy: "cliente", targetEntity: EPrenotazione::class, cascade: ["persist", "remove"])]
    private Collection $prenotazioni;

    public function __construct() {
        parent::__construct();
        $this->iscrizioni = new ArrayCollection();
        $this->prenotazioni = new ArrayCollection();
    }
    // ISCRIZIONI
    public function getIscrizioni(): Collection {
        return $this->iscrizioni;
    }

    public function addIscrizione(EIscrizione $iscrizione): self {
        if (!$this->iscrizioni->contains($iscrizione)) {
            $this->iscrizioni[] = $iscrizione;
            $iscrizione->setCliente($this);
        }
        return $this;
    }

    public function removeIscrizione(EIscrizione $iscrizione): self {
        if ($this->iscrizioni->removeElement($iscrizione)) {
            $iscrizione->setCliente(null);
        }
        return $this;
    }

    // PRENOTAZIONI
    public function getPrenotazioni(): Collection {
        return $this->prenotazioni;
    }

    public function addPrenotazione(EPrenotazione $prenotazione): self {
        if (!$this->prenotazioni->contains($prenotazione)) {
            $this->prenotazioni[] = $prenotazione;
            $prenotazione->setCliente($this);
        }
        return $this;
    }

    public function removePrenotazione(EPrenotazione $prenotazione): self {
        if ($this->prenotazioni->removeElement($prenotazione)) {
            $prenotazione->setCliente(null);
        }
        return $this;
    }
}