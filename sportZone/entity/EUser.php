<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Enum\UserSex;

#[ORM\Entity]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(value: ["client" => EClient::class, "employee" => EEmployee::class, "instructor" => EInstructor::class])]
#[ORM\Table(name: "users")]

abstract class EUser
{



    #[ORM\OneToMany(mappedBy: "user", targetEntity: EReservation::class, cascade: ["persist", "remove"])]
    private Collection $reservations;



    #[ORM\Id]
    #[ORM\GeneratedValue("AUTO")]
    #[ORM\Column(type: "integer")]
    protected int $id;

    #[ORM\Column(type: "string", nullable: false)]
    protected string $name;

    #[ORM\Column(type: "string", nullable: false)]
    protected string $surname;

    #[ORM\Column(type: "date", nullable: false)]
    protected \DateTimeInterface $birthDate;

    #[ORM\Column(type: "string", nullable: false)]
    protected string $sex;

    #[ORM\Column(type: "string", nullable: false, unique: true)]
    protected string $email;

    #[ORM\Column(type: "string", nullable: false, unique: true)]
    protected string $username;

    #[ORM\Column(type: "string", nullable: false)]
    protected string $password;

    #[ORM\Column(type: "string", nullable: true)]
    protected ?string $profilePicture;

    // Getters e Setters possono essere aggiunti qui

    public function getId(): int {
        return $this->id;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setSurname(string $surname): self {
        $this->surname = $surname;
        return $this;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSex(UserSex $sex): self {
        $this->sex = $sex->value;
        return $this;
    }

    public function getSex(): UserSex {
        return UserSex::from($this->sex);
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getBirthDate(): \DateTimeInterface {
        return $this->birthDate;
    }

    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setPassword(string $password): self {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $hashedPassword;
        return $this;
    }

    public function getPasswordHashed(): string {
        return $this->password;
    }

    public function setUsername(string $username): self {
        $this->username = $username;
        return $this;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getFullName(): string {
        return $this->getName() .' '. $this->getSurname();
    }

    public function getProfilePicture(): ?string {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePictureName): self {
        $this->profilePicture = $profilePictureName;
        return $this;
    }

    public function getReservations(): Collection {
        return $this->reservations;
    }

    public function addReservation(EReservation $reservation): self {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setUser($this);
        }
        return $this;
    }

    public function removeReservation(EReservation $reservation): self {
        if ($this->reservations->removeElement($reservation)) {
            $reservation->setUser(null);
        }
        return $this;
    }

    public function getType(): string {
        return match (get_class($this)) {
            EClient::class => 'client',
            EInstructor::class => 'instructor',
            EEmployee::class => 'employee',
            default => 'unknown',
        };
    }

    public static function usertoArray($user) {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'sex'=> 'male',
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
            'birthDate' => $user->getBirthDate()->format('Y-m-d'),
            'profilePicture' => UImage::getImageFullPath($user->getProfilePicture())
        ];
    }
}