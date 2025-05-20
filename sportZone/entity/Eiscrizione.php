<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Iscrizione
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "date")]
    private \DateTime $data_iscrizione; //include anche orario

    // ======= RELAZIONI =======

    #[ORM\ManyToOne(targetEntity: Cliente::class, inversedBy: "corsi")]
    private ?Cliente $cliente = null;

    #[ORM\OneToOne(targetEntity: Corso::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Corso $corso = null;

    // ========= GETTERS & SETTERS ==========

    public function getId(): int {
        return $this->id;
    }

    public function getDataIscrizione(): \DateTime {
        return $this->data_iscrizione;
    }

    public function setDataIscrizione(\DateTime $data): void {
        $this->data_iscrizione = $data;
    }

    public function getCliente(): ?Cliente {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): void {
        $this->cliente = $cliente;
    }

    public function getCorso(): ?Corso {
        return $this->corso;
    }

    public function setCorso(?Corso $corso): void {
        $this->corso = $corso;
    }
}