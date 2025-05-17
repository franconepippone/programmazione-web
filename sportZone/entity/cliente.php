<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Cliente extends Utente
{
    #[ORM\OneToMany(mappedBy: "cliente", targetEntity: Iscrizione::class, cascade: ["persist", "remove"])]
    private Collection $iscrizioni;

    #[ORM\OneToMany(mappedBy: "cliente", targetEntity: Prenotazione::class, cascade: ["persist", "remove"])]
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

    public function addIscrizione(Iscrizione $iscrizione): self {
        if (!$this->iscrizioni->contains($iscrizione)) {
            $this->iscrizioni[] = $iscrizione;
            $iscrizione->setCliente($this);
        }
        return $this;
    }

    public function removeIscrizione(Iscrizione $iscrizione): self {
        if ($this->iscrizioni->removeElement($iscrizione)) {
            $iscrizione->setCliente(null);
        }
        return $this;
    }

    // PRENOTAZIONI
    public function getPrenotazioni(): Collection {
        return $this->prenotazioni;
    }

    public function addPrenotazione(Prenotazione $prenotazione): self {
        if (!$this->prenotazioni->contains($prenotazione)) {
            $this->prenotazioni[] = $prenotazione;
            $prenotazione->setCliente($this);
        }
        return $this;
    }

    public function removePrenotazione(Prenotazione $prenotazione): self {
        if ($this->prenotazioni->removeElement($prenotazione)) {
            $prenotazione->setCliente(null);
        }
        return $this;
    }
}