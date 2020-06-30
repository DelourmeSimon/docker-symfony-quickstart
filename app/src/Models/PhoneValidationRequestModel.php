<?php
namespace App\Models;

class PhoneValidationRequestModel {

    private $phoneNumber;

	private $countryCode;

	public function getPhoneNumber(): ?string 
	{
		return $this->phoneNumber;
	}

	public function setPhoneNumber(string $phoneNumber): PhoneValidationRequestModel 
	{
		$this->phoneNumber = $phoneNumber;

		return $this;
	}

	public function getCountryCode(): ?string 
	{
		return $this->countryCode;
	}

	public function setCountryCode(string $countryCode): PhoneValidationRequestModel 
	{
		$this->countryCode = $countryCode;

		return $this;
	}

}