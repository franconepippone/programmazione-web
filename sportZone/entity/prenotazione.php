<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "prenotazioni")]
class Prenotazione
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "time")]
    private \DateTimeInterface $orario_prenotazione;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $data_prenotazione;

    #[ORM\ManyToOne(targetEntity: Campo::class, inversedBy: "prenotazioni")]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private Campo $campo;

    #[ORM\ManyToOne(targetEntity: Cliente::class, inversedBy: "prenotazioni")]
    #[ORM\JoinColumn(nullable: false)]
    private Cliente $cliente;

    #[ORM\OneToOne(targetEntity: Pagamento::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    private Pagamento $pagamento;

    public function __construct(
        \DateTimeInterface $orario,
        \DateTimeInterface $data,
        Campo $campo,
        Cliente $cliente,
        Pagamento $pagamento
    ) {
        $this->orario_prenotazione = $orario;
        $this->data_prenotazione = $data;
        $this->campo = $campo;
        $this->cliente = $cliente;
        $this->pagamento = $pagamento;
    }

    // Getter e Setter

    public function getId(): int {
        return $this->id;
    }

    public function getOrarioPrenotazione(): \DateTimeInterface {
        return $this->orario_prenotazione;
    }

    public function setOrarioPrenotazione(\DateTimeInterface $orario): void {
        $this->orario_prenotazione = $orario;
    }

    public function getDataPrenotazione(): \DateTimeInterface {
        return $this->data_prenotazione;
    }

    public function setDataPrenotazione(\DateTimeInterface $data): void {
        $this->data_prenotazione = $data;
    }

    public function getCampo(): Campo {
        return $this->campo;
    }

    public function setCampo(Campo $campo): void {
        $this->campo = $campo;
    }

    public function getCliente(): Cliente {
        return $this->cliente;
    }

    public function setCliente(Cliente $cliente): void {
        $this->cliente = $cliente;
    }

    public function getPagamento(): Pagamento {
        return $this->pagamento;
    }

    public function setPagamento(Pagamento $pagamento): void {
        $this->pagamento = $pagamento;
    }
}