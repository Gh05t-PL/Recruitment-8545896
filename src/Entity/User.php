<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as MyAssert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Name can't be empty")
     * @Assert\Regex(pattern="/^[a-z ,.'-]+$/i", message="Name must be written in arabic alphabet")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Surname can't be empty")
     * @Assert\Regex(pattern="/^[a-z ,.'-]+$/i", message="Name must be written in arabic alphabet")
     */
    private $surname;

    /**
     * @ORM\Column(type="smallint")
     *
     * @Assert\NotBlank(message="Age can't be empty")
     * @Assert\Type(message="Age must be an integer", type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Phone number can't be empty")
     * @Assert\Regex(
     *     pattern="/(([+][(]?[0-9]{1,3}[)]?)|([(]?[0-9]{4}[)]?))\s*[)]?[-\s\.]?[(]?[0-9]{1,3}[)]?([-\s\.]?[0-9]{3})([-\s\.]?[0-9]{3,4})/i",
     *     message="Phone number format must be valid"
     * )
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Email can't be empty")
     * @Assert\Email(message="Email must be valid")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Email can't be empty")
     * @Assert\Type(type="string", message="Password must be a string")
     * @Assert\Length(min="6", minMessage="Password must be at least 6 character long")
     */
    private $password;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     *
     * @Assert\Type(type="numeric", message="Hourly Rate must be a number")
     * @Assert\Positive(message="Hourly Rate must be positive number")
     * @MyAssert\NumberScale(scale="2", message="Hourly Rate can have maximum 2 decimals")
     */
    private $hourlyRate;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getHourlyRate(): ?float
    {
        return $this->hourlyRate;
    }

    public function setHourlyRate(float $hourlyRate): self
    {
        $this->hourlyRate = $hourlyRate;

        return $this;
    }
}
