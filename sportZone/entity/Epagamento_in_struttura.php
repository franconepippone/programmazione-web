<?php
use Doctrine\ORM\Mapping as ORM;

require_once("Epagamento.php");

#[ORM\Entity]
class EPagamentoInStruttura extends EPagamento {}