<?php
use Doctrine\ORM\Mapping as ORM;

require_once("EField.php");

#[ORM\Entity]
#[ORM\Table(name: "images")]
 class EImage{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;
    
    #[ORM\Column(type: "string")]
    private $name;
    
    #[ORM\Column(type: "integer")]
    private $size;

    #[ORM\Column(type: "string")]
    private $types;

    #[ORM\Column(type: "blob")]
    private $imageData;

    #[ORM\ManyToOne(targetEntity: EField::class, inversedBy: "image", cascade: ["persist", "remove"])]
    private EField $field;
    
    public function __construct($name, $size, $type, $imageData){
        $this->name = $name;
        $this->size = $size;
        $this->types = $type;
        $this->imageData = $imageData;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getType()
    {
        return $this->types;
    }

    public function getImageData()
    {
        return $this->imageData;
    }

    public function getField(): EField
    {
        return $this->field;
    }

    public function getEncodedData(){
        if(is_resource($this->imageData)){
            $data = stream_get_contents($this->imageData);
            return base64_encode($data);
        }else{
            return base64_encode($this->imageData);
        }
        
    }

    public function setField(?EField $field): self {
        $this->field = $field;
        return $this;
    }
}