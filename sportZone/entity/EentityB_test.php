<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: "tabella_entityB_test")]
/**
 * Questa classe serve a completare la classe EntityTemplate, che si trova nell'altro file.
 * Questa classe ha una relazione N..1 con la classe EntityTemplate.
 */
class EntityB
{  
    #[ORM\Id]
    #[ORM\GeneratedValue("AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type:"string", nullable: false)]
    private string $name = "";

    /* Questa classe ha una relazione di tipo N..1 con la classe EntityTemplate, definita nell'altro file.
    * Questo qui sotto è il modo in cui si dichiara questo tipo di relazioni.
    */
    #[ORM\ManyToOne(targetEntity: EntityA::class, inversedBy:"listaDiEntitaB")]
    private ?EntityA $entityA = null; // in questo attributo è memorizzato il riferimento a entity1

    public function setEntityA(?EntityA $entityA): self
    {
        $this->entityA = $entityA;
        return $this; // supporta la concatenazione di metodi (non c'entra niente con doctrine o ORM)
    }

    // Semplicemente un costruttore che permette di settare l'attributo "name" 
    public function __construct(string $name) {
        $this->name = $name;
    }

}