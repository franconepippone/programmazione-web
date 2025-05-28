<?php
use Doctrine\ORM\Mapping as ORM;

require_once("EPaymentMethod.php");

#[ORM\Entity]
#[ORM\Table(name: "on_site_payments")]

class EOnSitePayment extends EPaymentMethod {}