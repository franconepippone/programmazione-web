<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "campi")]
class ECampo
{
    #[ORM\Id]
    #[ORM\GeneratedValue("AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $sport;

    #[ORM\Column(type: "integer")]
    private int $numero;

    #[ORM\Column(type: "string")]
    private string $tipologia_terreno;

    #[ORM\Column(type: "boolean")]
    private bool $al_coperto;

    #[ORM\Column(type: "float")]
    private float $costo_h;

    #[ORM\OneToMany(mappedBy: "campo", targetEntity: ECorso::class, cascade: ["persist", "remove"])]
    private Collection $corsi;

    #[ORM\OneToMany(mappedBy: "campo", targetEntity: EPrenotazione::class, cascade: ["persist", "remove"])]
    private Collection $prenotazioni;

    public function __construct() {
        $this->corsi = new ArrayCollection();
        $this->prenotazioni = new ArrayCollection();
    }

    // getters/setters...

    public function getId(): int { 
        return $this->id; 
    }

    public function setSport(string $sport): self {
        $this->sport = $sport;
        return $this;
    }
    
    public function getSport(): string {
        return $this->sport;
    }

    public function setNumero(int $numero): self {
        $this->numero = $numero;
        return $this;
    }

    public function getNumero(): int {
        return $this->numero;
    }

    public function setCoperto(bool $al_coperto): self {
        $this->al_coperto = $al_coperto;
        return $this;
    }

    public function getCoperto(): bool {
        return $this->al_coperto;
    }

    public function setTipologiaTerreno(string $tipologiaTerreno): self {
        $this->tipologia_terreno = $tipologiaTerreno;
        return $this;
    }

    public function getTipologiaTerreno(): string {
        return $this->tipologia_terreno;
    }

    public function setCosto(float $costo_h): self {
        $this->costo_h = $costo_h;
        return $this;
    }

    public function getCosto(): float {
        return $this->costo_h;
    }

    public function getCorsi(): Collection {
        return $this->corsi;
    }

    public function addCorso(ECorso $corso): self {
        if (!$this->corsi->contains($corso)) {
            $this->corsi->add($corso);
            $corso->setCampo($this);
        }
        return $this;
    }

    public function removeCorso(ECorso $corso): self {
        if ($this->corsi->removeElement($corso)) {
            // evita di lasciare riferimenti pendenti
            if ($corso->getCampo() === $this) {
                $corso->setCampo(null);
            }
        }
        return $this;
    }

    public function getPrenotazioni(): Collection {
        return $this->prenotazioni;
    }

    public function addPrenotazione(EPrenotazione $prenotazione): self {
        if (!$this->prenotazioni->contains($prenotazione)) {
            $this->prenotazioni->add($prenotazione);
            $prenotazione->setCampo($this);
        }
        return $this;
    }

    public function removePrenotazione(EPrenotazione $prenotazione): self {
        if ($this->prenotazioni->removeElement($prenotazione)) {
            if ($prenotazione->getCampo() === $this) {
                $prenotazione->setCampo(null);
            }
        }
        return $this;
    }
}


// eliminando un campo non si elimina un corso associato, ma eliminando un campo si elinima una prenotazione associata