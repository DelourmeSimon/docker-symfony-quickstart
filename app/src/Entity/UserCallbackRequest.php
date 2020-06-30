<?php
// src/Entity/UserCallbackRequest.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="user_callback_request")
 * @ORM\Entity
 */
class UserCallbackRequest {

 	/**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
	private $firstName;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
	private $lastName;

    /**
     * @Assert\Country
     * @ORM\Column(type="string", length=5)
     */
	private $country;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=10)
     */
	private $phoneNumber;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
	private $internationalPhoneNumber;

	public function getId(): ?int 
	{
		return $this->id;
	}

	public function getFirstName(): ?string 
	{
		return $this->firstName;
	}

	public function setFirstName(string $firstName): UserCallbackRequest 
	{
		$this->firstName = $firstName;

		return $this;
	}

	public function getLastName(): ?string 
	{
		return $this->lastName;
	}

	public function setLastName(string $lastName): UserCallbackRequest 
	{
		$this->lastName = $lastName;

		return $this;
	}

	public function getCountry(): ?string 
	{
		return $this->country;
	}

	public function setCountry(string $country): UserCallbackRequest 
	{
		$this->country = $country;

		return $this;
	}

	public function getPhoneNumber(): ?string 
	{
		return $this->phoneNumber;
	}

	public function setPhoneNumber(string $phoneNumber): UserCallbackRequest 
	{
		$this->phoneNumber = $phoneNumber;

		return $this;
	}

	public function getInternationalPhoneNumber(): ?string 
	{
		return $this->internationalPhoneNumber;
	}

	public function setInternationalPhoneNumber(string $internationalPhoneNumber): UserCallbackRequest 
	{
		$this->internationalPhoneNumber = $internationalPhoneNumber;

		return $this;
	}
}