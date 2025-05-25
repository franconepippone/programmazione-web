<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "tipo_pagamento", type: "string")]
#[ORM\DiscriminatorMap(["online" => EPagamentoOnline::class, "struttura" => EPagamentoInStruttura::class])]
#[ORM\Table(name: "pagamenti")]
abstract class EPagamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected int $id;

    #[ORM\Column(type: "float")]
    protected float $importo;

    #[ORM\Column(type: "date")]
    protected \DateTimeInterface $data;

    #[ORM\Column(type: "time")]
    protected \DateTimeInterface $ora;

    #[ORM\OneToOne(mappedBy: "pagamento", targetEntity: EPrenotazione::class)]
    protected ?EPrenotazione $prenotazione = null;

    #[ORM\OneToOne(mappedBy: "pagamento", targetEntity: EIscrizione::class)]
    protected ?EIscrizione $iscrizione = null;

    #[ORM\ManyToOne(targetEntity: EDipendente::class, inversedBy: "pagamenti")]
    protected ?EDipendente $dipendente = null;

    public function __construct() {}

    public function getId(): int {
        return $this->id;
    }

    public function getImporto(): float {
        return $this->importo;
    }

    public function setImporto(float $importo): void {
        $this->importo = $importo;
    }

    public function getData(): \DateTimeInterface {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): void {
        $this->data = $data;
    }

    public function getOra(): \DateTimeInterface {
        return $this->ora;
    }

    public function setOra(\DateTimeInterface $ora): void {
        $this->ora = $ora;
    }

    public function getPrenotazione(): ?EPrenotazione {
        return $this->prenotazione;
    }

    public function setPrenotazione(?EPrenotazione $prenotazione): void {
        $this->prenotazione = $prenotazione;
    }

    public function getIscrizione(): ?EIscrizione {
        return $this->iscrizione;
    }

    public function setIscrizione(?EIscrizione $iscrizione): void {
        $this->iscrizione = $iscrizione;
    }

    public function getDipendente(): ?EDipendente {
        return $this->dipendente;
    }

    public function setDipendente(?EDipendente $dipendente): void {
        $this->dipendente = $dipendente;
    }
}