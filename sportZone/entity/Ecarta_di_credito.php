<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "carte_di_credito")]
class ECartaDiCredito
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 20)]
    private string $numeroCarta;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $dataScadenza;

    #[ORM\Column(type: "string", length: 50)]
    private string $circuito;

    #[ORM\Column(type: "string", length: 50)]
    private string $banca;

    #[ORM\Column(type: "string", length: 100)]
    private string $titolareCarta;

    // Relazione molti a uno con PagamentoOnline
    #[ORM\ManyToOne(targetEntity: EPagamentoOnline::class, inversedBy: "carteDiCredito")]
    #[ORM\JoinColumn(nullable: false)]
    private EPagamentoOnline $pagamentoOnline;

    // Constructor
    public function __construct(
        string $numeroCarta,
        \DateTimeInterface $dataScadenza,
        string $circuito,
        string $banca,
        string $titolareCarta,
        EPagamentoOnline $pagamentoOnline
    ) {
        $this->numeroCarta = $numeroCarta;
        $this->dataScadenza = $dataScadenza;
        $this->circuito = $circuito;
        $this->banca = $banca;
        $this->titolareCarta = $titolareCarta;
        $this->pagamentoOnline = $pagamentoOnline;
    }

    // Getters e setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getNumeroCarta(): string
    {
        return $this->numeroCarta;
    }

    public function setNumeroCarta(string $numeroCarta): self
    {
        $this->numeroCarta = $numeroCarta;
        return $this;
    }

    public function getDataScadenza(): \DateTimeInterface
    {
        return $this->dataScadenza;
    }

    public function setDataScadenza(\DateTimeInterface $dataScadenza): self
    {
        $this->dataScadenza = $dataScadenza;
        return $this;
    }

    public function getCircuito(): string
    {
        return $this->circuito;
    }

    public function setCircuito(string $circuito): self
    {
        $this->circuito = $circuito;
        return $this;
    }

    public function getBanca(): string
    {
        return $this->banca;
    }

    public function setBanca(string $banca): self
    {
        $this->banca = $banca;
        return $this;
    }

    public function getTitolareCarta(): string
    {
        return $this->titolareCarta;
    }

    public function setTitolareCarta(string $titolareCarta): self
    {
        $this->titolareCarta = $titolareCarta;
        return $this;
    }

    public function getPagamentoOnline(): EPagamentoOnline
    {
        return $this->pagamentoOnline;
    }

    public function setPagamentoOnline(?EPagamentoOnline $pagamentoOnline): self
    {
        $this->pagamentoOnline = $pagamentoOnline;
        return $this;
    }
}