<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class EIscrizione
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "date")]
    private \DateTime $data_iscrizione; //include anche orario

    // ======= RELAZIONI =======

    #[ORM\ManyToOne(targetEntity: ECliente::class, inversedBy: "corsi")]
    private ?ECliente $cliente = null;

    #[ORM\OneToOne(targetEntity: ECorso::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ECorso $corso = null;

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

    public function getCliente(): ?ECliente {
        return $this->cliente;
    }

    public function setCliente(?ECliente $cliente): void {
        $this->cliente = $cliente;
    }

    public function getCorso(): ?ECorso {
        return $this->corso;
    }

    public function setCorso(?ECorso $corso): void {
        $this->corso = $corso;
    }
}