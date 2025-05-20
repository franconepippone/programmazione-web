<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "tipo_pagamento", type: "string")]
#[ORM\DiscriminatorMap(["online" => PagamentoOnline::class, "struttura" => PagamentoInStruttura::class])]
#[ORM\Table(name: "pagamento")]
abstract class Pagamento
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

    #[ORM\OneToOne(mappedBy: "pagamento", targetEntity: Prenotazione::class)]
    protected ?Prenotazione $prenotazione = null;

    #[ORM\OneToOne(mappedBy: "pagamento", targetEntity: Iscrizione::class)]
    protected ?Iscrizione $iscrizione = null;

    #[ORM\ManyToOne(targetEntity: Dipendente::class, inversedBy: "pagamenti")]
    protected ?Dipendente $dipendente = null;

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

    public function getPrenotazione(): ?Prenotazione {
        return $this->prenotazione;
    }

    public function setPrenotazione(?Prenotazione $prenotazione): void {
        $this->prenotazione = $prenotazione;
    }

    public function getIscrizione(): ?Iscrizione {
        return $this->iscrizione;
    }

    public function setIscrizione(?Iscrizione $iscrizione): void {
        $this->iscrizione = $iscrizione;
    }

    public function getDipendente(): ?Dipendente {
        return $this->dipendente;
    }

    public function setDipendente(?Dipendente $dipendente): void {
        $this->dipendente = $dipendente;
    }
}