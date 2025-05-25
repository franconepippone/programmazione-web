<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

require_once("Eutente.php");

#[ORM\Entity]
#[ORM\Table(name: "istruttori")]

class EIstruttore extends EUtente
{
    #[ORM\Column(type: "text", nullable: true)]
    private ?string $cv = null;

    #[ORM\OneToMany(mappedBy: "istruttore", targetEntity: ECorso::class, cascade: ["persist", "remove"])]
    private Collection $corsi;

    public function __construct() {
        parent::__construct();
        $this->corsi = new ArrayCollection();
    }

    public function getCv(): ?string {
        return $this->cv;
    }

    public function setCv(?string $cv): void {
        $this->cv = $cv;
    }

    public function getCorsi(): Collection {
        return $this->corsi;
    }

    public function addCorso(ECorso $corso): self {
        if (!$this->corsi->contains($corso)) {
            $this->corsi[] = $corso;
            $corso->setIstruttore($this);
        }
        return $this;
    }

    public function removeCorso(ECorso $corso): self {
        if ($this->corsi->removeElement($corso)) {
            $corso->setIstruttore(null);
        }
        return $this;
    }
}