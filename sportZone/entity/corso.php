<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Corso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $nome;

    #[ORM\Column(type: "date")]
    private \DateTime $data_inizio;

    #[ORM\Column(type: "date")]
    private \DateTime $data_fine;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $descrizione = null;

    #[ORM\Column(type: "string", length: 50)]
    private string $orario;

    #[ORM\Column(type: "float")]
    private float $costo_iscrizione;

    #[ORM\Column(type: "integer")]
    private int $max_iscritti;

    // ======= RELAZIONI =======

    #[ORM\ManyToOne(targetEntity: Istruttore::class, inversedBy: "corsi")]
    private ?Istruttore $istruttore = null;

    #[ORM\ManyToMany(targetEntity: Dipendente::class, mappedBy: "corsi")]
    private Collection $dipendenti;

    #[ORM\ManyToOne(targetEntity: Campo::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Campo $campo = null;

    #[ORM\OneToMany(mappedBy: "corso", targetEntity: Iscrizione::class, cascade: ["persist", "remove"])]
    private Collection $iscrizioni;

    public function __construct() {
        $this->dipendenti = new ArrayCollection();
        $this->iscrizioni = new ArrayCollection();
    }

    // ========= GETTERS & SETTERS ==========

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getDataInizio(): \DateTime {
        return $this->data_inizio;
    }

    public function setDataInizio(\DateTime $data): void {
        $this->data_inizio = $data;
    }

    public function getDataFine(): \DateTime {
        return $this->data_fine;
    }

    public function setDataFine(\DateTime $data): void {
        $this->data_fine = $data;
    }

    public function getDescrizione(): ?string {
        return $this->descrizione;
    }

    public function setDescrizione(?string $descrizione): void {
        $this->descrizione = $descrizione;
    }

    public function getOrario(): string {
        return $this->orario;
    }

    public function setOrario(string $orario): void {
        $this->orario = $orario;
    }

    public function getCostoIscrizione(): float {
        return $this->costo_iscrizione;
    }

    public function setCostoIscrizione(float $costo): void {
        $this->costo_iscrizione = $costo;
    }

    public function getMaxIscritti(): int {
        return $this->max_iscritti;
    }

    public function setMaxIscritti(int $max): void {
        $this->max_iscritti = $max;
    }

    public function getIstruttore(): ?Istruttore {
        return $this->istruttore;
    }

    public function setIstruttore(?Istruttore $istruttore): void {
        $this->istruttore = $istruttore;
    }

    public function getDipendenti(): Collection {
        return $this->dipendenti;
    }

    public function addDipendente(Dipendente $dipendente): self {
        if (!$this->dipendenti->contains($dipendente)) {
            $this->dipendenti->add($dipendente);
        }
        return $this;
    }

    public function removeDipendente(Dipendente $dipendente): self {
        $this->dipendenti->removeElement($dipendente);
        return $this;
    }

    public function getCampo(): Campo {
        return $this->campo;
    }

    public function setCampo(Campo $campo): void {
        $this->campo = $campo;
    }

    public function getIscrizioni(): Collection {
        return $this->iscrizioni;
    }

    public function addIscrizione(Iscrizione $iscrizione): self {
        if (!$this->iscrizioni->contains($iscrizione)) {
            $this->iscrizioni->add($iscrizione);
            $iscrizione->setCorso($this); // sincronizza il lato inverso
        }
        return $this;
    }

    public function removeIscrizione(Iscrizione $iscrizione): self {
        if ($this->iscrizioni->removeElement($iscrizione)) {
            if ($iscrizione->getCorso() === $this) {
                $iscrizione->setCorso(null);
            }
        }
        return $this;
    }
}