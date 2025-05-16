<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/** I file EentityA_test.php e EentityB_test.php sono da esempio per capire come vanno definite le classi entità
 * e come vanno commentate con # per il mappaggio sul database. In questo caso, la classe EntityA ha una
 * relazione 1..N con la classe EntityB (pensatele rispettivamente come una classe "User" e una classe "Post"; lo user ha tanti post,
 * ma ogni post è di un solo user), e viene mostrato nelle due classi come questi tipi di relazioni vanno gestite sia a livello di php
 * che a livello di ORM (commenti con #)
 */


#[ORM\Entity]
#[ORM\Table(name: "tabella_entityA_test")]
/**
 * Questo è un template per le classi entity; per creare altre classi entity, partite da questa. Aggiungete
 * metodi e attributi necessari (i #[..] sono per le specifiche per il mappaggio per il database)
 * 
 * - americo
 */
class EntityA
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

    /**
     * Immaginate che questa classe abbia una relazione di tipo 1..N con la classe EntityB, definita nell'altro file.
     * Questo qui sotto è il modo in cui si dicharano questo tipo di relazioni.
     */
    #[ORM\OneToMany(targetEntity: EntityB::class, mappedBy:"entityA", cascade: ["persist", "remove"])]
    private Collection $listaDiEntitaB; // in questo "array" sono memorizzate tutti i riferimenti agli oggetti di classe Entity2

    //Questo è il costruttore della classe. Crea un instanza di ArrayCollection e la assegna all'attributo.
    public function __construct() {
      $this->listaDiEntitaB = new ArrayCollection();
    }


    // ----------- SETTERS / GETTERS --------------------
    
    public function getId(): int {
      return $this->id; 
    }

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

    /**
     * L'interazione con le collection deve essere sempre gestita da metodi di Add/Remove o altro,
     * che si interfacciano internamente con la collection
     */
    public function addEntityB(EntityB $entityB): self {
      // se l'entità non è gia presente...
      if (!$this->listaDiEntitaB->contains($entityB)) {
        $this->listaDiEntitaB->add($entityB); // aggiungi l'entità
        $entityB->setEntityA($this); // NB: aggiorna l'attributo dell'entitàB con un riferimento a questa classe ($this)
        // Quest'ultima riga è IMPORTANTE perché permette all'oggetto di classe entityB di conoscere a quale entityA è associata. 
    }
    return $this; // supporta la concatenazione di metodi (non c'entra niente con doctrine o ORM)
    }

    // Simile al precedente, solo per la rimozione.
    public function removeEntityB(EntityB $entityB): self {
      if ($this->listaDiEntitaB->contains($entityB)) {
        $this->listaDiEntitaB->removeElement($entityB);
        $entityB->setEntityA(null); // IMPORTANTE: rimuove l'associazione su entityB con questa entityA
      }
      return $this;
    }
}