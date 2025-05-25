<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "prenotazioni")]
class EPrenotazione
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "time")]
    private \DateTimeInterface $orario_prenotazione;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $data_prenotazione;

    #[ORM\ManyToOne(targetEntity: ECampo::class, inversedBy: "prenotazioni")]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ECampo $campo;

    #[ORM\ManyToOne(targetEntity: ECliente::class, inversedBy: "prenotazioni")]
    #[ORM\JoinColumn(nullable: false)]
    private ECliente $cliente;

    #[ORM\OneToOne(targetEntity: EPagamento::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false)]
    private EPagamento $pagamento;

    public function __construct(
        \DateTimeInterface $orario,
        \DateTimeInterface $data,
        ECampo $campo,
        ECliente $cliente,
        EPagamento $pagamento
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

    public function getCampo(): ECampo {
        return $this->campo;
    }

    public function setCampo(?ECampo $campo): void {
        $this->campo = $campo;
    }

    public function getCliente(): ECliente {
        return $this->cliente;
    }

    public function setCliente(?ECliente $cliente): void {
        $this->cliente = $cliente;
    }

    public function getPagamento(): EPagamento {
        return $this->pagamento;
    }

    public function setPagamento(EPagamento $pagamento): void {
        $this->pagamento = $pagamento;
    }
}