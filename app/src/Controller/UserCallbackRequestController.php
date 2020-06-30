<?php
namespace App\Controller;

use App\Entity\UserCallbackRequest;
use App\Forms\UserCallbackRequestType;
use App\Services\PhoneNumberValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserCallbackRequestController extends AbstractController
{
    /**
     * @Route("/", name="create_callback_request")
     */
    public function indexAction(Request $request)
    {
        $callbackRequestForm = $this->createForm(UserCallbackRequestType::class, $userCallbackRequest = new UserCallbackRequest());
        $callbackRequestForm->handleRequest($request);

        if ($callbackRequestForm->isSubmitted() && $callbackRequestForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userCallbackRequest);
            $entityManager->flush();

            return $this->redirectToRoute('callback_request_success');
        }

        return $this->render('userCallbackRequest/callbackRequestForm.html.twig', 
        [
            'callback_request_form' => $callbackRequestForm->createView()
        ]);
    }

    /**
     * @Route("/success", name="callback_request_success", methods={"GET"})
     */
    public function successCallbackRequestAction()
    {
        return $this->render('userCallbackRequest/callbackRequestSuccess.html.twig');
    }

    /**
     * @Route("/list", name="callback_request_list")
     */
    public function listAction()
    {
        $entityManager = $this->getDoctrine()->getRepository(UserCallbackRequest::class);
        $requests = $entityManager->findAll();

        return $this->render(
            'userCallbackRequest/callbackRequestList.html.twig', [
            'requests' => $requests
        ]);
    }

    /**
     * @Route("/validate-phone", name="callback_request_phone_validation", methods={"POST"})
     */
    public function validatePhoneAction(Request $request, PhoneNumberValidator $validator, SerializerInterface $serializer)
    {
        try {
            $response = $validator->validate($request->get('phoneNumber'), $request->get('countryCode'));
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($serializer->serialize($response, 'json'), Response::HTTP_OK, [], true);
    }
}