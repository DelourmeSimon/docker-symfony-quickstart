<?php
namespace App\Models;

class PhoneValidationResponseModel {

    private $phoneNumberInternational;

	private $isValid;

	public function getPhoneNumberInternational(): ?string 
	{
		return $this->phoneNumberInternational;
	}

	public function setPhoneNumberInternational(string $phoneNumberInternational): PhoneValidationResponseModel 
	{
		$this->phoneNumberInternational = $phoneNumberInternational;

		return $this;
	}

	public function isValid(): ?bool 
	{
		return $this->isValid;
	}

	public function setIsValid(bool $isValid): PhoneValidationResponseModel 
	{
		$this->isValid = $isValid;

		return $this;
	}

}