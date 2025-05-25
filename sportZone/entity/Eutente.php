<?php
use Doctrine\ORM\Mapping as ORM;
use App\Enum\SessoEnum;

#[ORM\Entity]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "tipo", type: "string")]
#[ORM\DiscriminatorMap(["cliente" => ECliente::class, "dipendente" => EDipendente::class, "istruttore" => EIstruttore::class])]
#[ORM\Table(name: "utenti")]

abstract class EUtente
{
    #[ORM\Id]
    #[ORM\GeneratedValue("AUTO")]
    #[ORM\Column(type: "integer")]
    protected int $id;

    #[ORM\Column(type: "string", nullable: false)]
    protected string $nome;

    #[ORM\Column(type: "string", nullable: false)]
    protected string $cognome;

    #[ORM\Column(type: "date", nullable: false)]
    protected \DateTimeInterface $data_nascita;

    #[ORM\Column(type: "string", nullable: false)]
    protected SessoEnum $sesso;

    #[ORM\Column(type: "string", nullable: false, unique: true)]
    protected string $email;

    #[ORM\Column(type: "string", nullable: false, unique: true)]
    protected string $nome_utente;

    #[ORM\Column(type: "string", nullable: false)]
    protected string $password;

    public function __construct() {}

    // Getters e Setters possono essere aggiunti qui

    public function getId(): int {
        return $this->id;
    }

    public function setNome(string $nome): self {
        $this->nome = $nome;
        return $this;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setCognome(string $cognome): self {
        $this->cognome = $cognome;
        return $this;
    }

    public function getCognome(): string {
        return $this->cognome;
    }

    public function setDataNascita(\DateTimeInterface $data_nascita): self {
        $this->data_nascita = $data_nascita;
        return $this;
    }

    public function getDataNascita(): \DateTimeInterface {
        return $this->data_nascita;
    }

    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setPassword(string $password): self {
        $this->password = $password;
        return $this;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setNomeUtente(string $nome_utente): self {
        $this->nome_utente = $nome_utente;
        return $this;
    }


}