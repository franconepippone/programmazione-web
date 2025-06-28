<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

require_once("EUser.php");

#[ORM\Entity]
#[ORM\Table(name: "admin")]

class EAdmin extends EUser
{
    public function __construct() {
        $this->paymentMethods = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

}
