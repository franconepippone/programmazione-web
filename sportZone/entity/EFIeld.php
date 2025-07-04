<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "fields")]
class EField
{
    #[ORM\Id]
    #[ORM\GeneratedValue("AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $name;

    #[ORM\Column(type: "string")]
    private string $sport;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $description = "";

    #[ORM\Column(type: "decimal", precision: 10, scale: 7)]
    private $latitude;

    #[ORM\Column(type: "decimal", precision: 10, scale: 7)]
    private $longitude;

    #[ORM\Column(type: "string")]
    private string $terrainType;

    #[ORM\Column(type: "boolean")]
    private bool $isIndoor;

    #[ORM\Column(type: "float")]
    private float $hourlyCost;

    #[ORM\Column(type: "json")]
    private array $images;

    #[ORM\OneToMany(mappedBy: "field", targetEntity: ECourse::class, cascade: ["persist", "remove"])]
    private Collection $courses;

    #[ORM\OneToMany(mappedBy: "field", targetEntity: EReservation::class, cascade: ["persist", "remove"])]
    private Collection $reservations;
    public function __construct() {
        $this->courses = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->images = [];
    }

    // getters/setters...

    public function getId(): int { 
        return $this->id; 
    }

    public function setSport(string $sport): self {
        $this->sport = $sport;
        return $this;
    }
    
    public function getSport(): string {
        return $this->sport;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }
    
    public function getName(): string {
        return $this->name;
    }


    public function setIsIndoor(bool $isIndoor): self {
        $this->isIndoor = $isIndoor;
        return $this;
    }

    public function getIsIndoor(): bool {
        return $this->isIndoor;
    }

    public function setTerrainType(string $terrainType): self {
        $this->terrainType = $terrainType;
        return $this;
    }

    public function getTerrainType(): string {
        return $this->terrainType;
    }

    public function setCost(float $hourlyCost): self {
        $this->hourlyCost = $hourlyCost;
        return $this;
    }

    public function getCost(): float {
        return $this->hourlyCost;
    }

    public function getCourses(): Collection {
        return $this->courses;
    }

    public function addCourse(ECourse $course): self {
        if (!$this->courses->contains($course)) {
            $this->courses->add($course);
            $course->setField($this);
        }
        return $this;
    }

    public function removeCourse(ECourse $course): self {
        if ($this->courses->removeElement($course)) {
            // evita di lasciare riferimenti pendenti
            if ($course->getField() === $this) {
                $course->setField(null);
            }
        }
        return $this;
    }

    public function getReservations(): Collection {
        return $this->reservations;
    }

    public function addReservation(EReservation $reservation): self {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setField($this);
        }
        return $this;
    }

    public function removeReservation(EReservation $reservation): self {
        if ($this->reservations->removeElement($reservation)) {
            if ($reservation->getField() === $this) {
                $reservation->setField(null);
            }
        }
        return $this;
    }

    public function addImage(string $path): self {
        if (!in_array($path, $this->images, true)) {
            $this->images[] = $path;
        }
        return $this;
    }

    public function removeImage(string $path): self {
        if (($key = array_search($path, $this->images, true)) !== false) {
            unset($this->images[$key]);
            // Reindex array to keep it sequential
            $this->images = array_values($this->images);
        }
        return $this;
    }

    /**
     * Remove all image paths.
     */
    public function removeAllImages(): self {
        $this->images = [];
        return $this;
    }

    public function getImages(): array {
        return $this->images;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public static function fieldToArray(EField $field) {
        $images = [];
        foreach ($field->getImages() as $imgName) {
            $imagePath = UImage::getImageFullPath($imgName);
            $images[] = $imagePath;
        }
        return [
            'name' => $field ->getName(),
            'id' => $field->getId(),
            'description' => $field->getDescription(),
            'hourlyCost' => $field->getCost(),
            'sport' => $field->getSport(),
            'latitude' => $field->getLatitude(),
            'longitude' => $field->getLongitude(),
            'terrainType' => $field ->getTerrainType(),
            'isIndoor' => $field ->getIsIndoor(),
            'images' => $images,
        ];
    }
}


// eliminando un field non si elimina un course associato, ma eliminando un field si elinima una reservation associata
