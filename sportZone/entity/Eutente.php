<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "tipo", type: "string")]
#[ORM\DiscriminatorMap(["cliente" => Cliente::class, "dipendente" => Dipendente::class, "istruttore" => Istruttore::class])]
#[ORM\Table(name: "utenti")]

abstract class Utente
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
    protected string $sesso;

    #[ORM\Column(type: "string", nullable: false, unique: true)]
    protected string $email;

    #[ORM\Column(type: "string", nullable: false, unique: true)]
    protected string $nome_utente;

    #[ORM\Column(type: "string", nullable: false)]
    protected string $password;

    public function __construct() {}

    // Getters e Setters possono essere aggiunti qui
}