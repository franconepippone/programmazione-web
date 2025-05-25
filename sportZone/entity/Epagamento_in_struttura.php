<?php
use Doctrine\ORM\Mapping as ORM;

require_once("Epagamento.php");

#[ORM\Entity]
#[ORM\Table(name: "pagamenti_in_struttura")]

class EPagamentoInStruttura extends EPagamento {}