<?php
use Doctrine\ORM\Mapping as ORM;
use App\Enum\UserSex;

#[ORM\Entity]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(value: ["client" => EClient::class, "employee" => EEmployee::class, "instructor" => EInstructor::class])]
#[ORM\Table(name: "users")]

abstract class EUser
{
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

    // construct (per semplificare l'instanziazione)
    public function __construct(
        string $name = '',
        string $surname = '',
        \DateTimeInterface $birthDate = new \DateTimeImmutable('1900-01-01'),
        UserSex $sex = UserSex::MALE,
        string $email = '',
        string $username = '',
        string $password = ''
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->setSex($sex);
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

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

    public function setDataNascita(\DateTimeInterface $birthDate): self {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getDataNascita(): \DateTimeInterface {
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
        $this->password = $password;
        return $this;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setUsername(string $username): self {
        $this->username = $username;
        return $this;
    }

    public function getUsername(): string {
        return $this->username;
    }


}