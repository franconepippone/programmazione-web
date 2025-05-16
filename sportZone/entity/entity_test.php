<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Questo è un template per le classi entity; per creare altre classi entity, partite da questa. Aggiungete
 * metodi e attributi necessari (i #[..] sono per le specifiche del database, li aggiungo io)
 * - americo
 */
#[ORM\Entity]
#[ORM\Table(name: "TabellaEntityTest")]
class EntityTemplate
{   
  /*
   * Tutti gli attributi vanno dichiarati come privati, e poi vanno aggiunti i metodi di set/get per ogniuno.
   * La sintassi è:  private <tipo> $<nome>;
   */

    #[ORM\Id]
    #[ORM\GeneratedValue("AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "integer", nullable: false)]
    private int $property1 = 0;

    /* Si mette ?<tipo> nel caso in cui il valore può essere nullo.
      * E infatti non è richiesto un valore di inizializzazione (il valore è null per default)
      */
    #[ORM\Column(type: "string", nullable: true)]
    private ?string $property2;

    
    #[ORM\OneToMany(mappedBy: )]
    private ?ArrayCollection $stringhe;

    public function setProperty1(int $value) {
      $this->property1 = $value;
    }

    public function getProperty1(): int {
      return $this->property1;
    }

    public function setProperty2(string $value) {
      $this->property2 = $value;
    }

    public function getProperty2(): ?string {
      return $this->property2;
    }
}