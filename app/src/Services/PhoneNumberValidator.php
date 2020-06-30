<?php
namespace App\Services;

use App\Models\PhoneValidationRequestModel;
use App\Models\PhoneValidationResponseModel;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Response\CurlResponse;
use Symfony\Component\Serializer\SerializerInterface;

class PhoneNumberValidator {

	private $client;
	private $serializer;
	private $phoneValidationApi;
	private $phoneValidationUser;
	private $phoneValidationPassword;

	public function __construct(
		SerializerInterface $serializer,
		string $phoneValidationApi,
		string $phoneValidationUser,
		string $phoneValidationPassword
	)
	{
		$this->client = HttpClient::create();
		$this->serializer = $serializer;
		$this->phoneValidationApi = $phoneValidationApi;
		$this->phoneValidationUser = $phoneValidationUser;
		$this->phoneValidationPassword = $phoneValidationPassword;
	}

	public function validate(string $phoneNumber, string $countryCode): PhoneValidationResponseModel 
	{
		$validationRequestModel = $this->buildRequestModel($phoneNumber, $countryCode);
        $response = $this->client->request(
            'POST',
            $this->phoneValidationApi,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => $this->serializer->serialize([$validationRequestModel], 'json'),
                'auth_basic' => [$this->phoneValidationUser, $this->phoneValidationPassword]
            ]
        );

        return $this->buildResponseModel($response); 
	}

	private function buildRequestModel(string $phoneNumber, string $countryCode): PhoneValidationRequestModel
	{
        return (new PhoneValidationRequestModel())
            ->setPhoneNumber($phoneNumber)
            ->setCountryCode($countryCode)
        ;
	}

	private function buildResponseModel(CurlResponse $data): PhoneValidationResponseModel
	{
		$response = json_decode($data->getContent());

		return (new PhoneValidationResponseModel())
            ->setPhoneNumberInternational($response[0]->output->internationalStrict)
            ->setIsValid($response[0]->output->isValid)
        ;
	}
}