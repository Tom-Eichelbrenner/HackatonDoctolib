<?php

namespace App\Controller;


use App\Entity\AdviceRequest;
use App\Entity\Messages;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function index()
    {
        $patient = $this->getUser()->getPatient();
        $requests = $patient->getAdviceRequests();

        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
            'patient' => $patient,
            'requests' => $requests
        ]);
    }

    /**
     * @Route("/{id}", name="conversation_show", methods={"GET","POST"}, requirements={"id":"\d+"})
     */
    public function show(AdviceRequest $adviceRequest, Request $request): Response
    {

        if (isset($_POST['submit']) and isset($_POST['message'])) {
            $message = new Messages();
            $entityManager = $this->getDoctrine()->getManager();
            $msg = $_POST['message'];
            $message->setAdviceRequest($adviceRequest);
            $date = new DateTime();
            $message->setDate($date);
            $message->setMessage($msg);

            $user = $this->getUser();
            $role = $user->getRoles();
            if (in_array('ROLE_DOCTOR', $role)) {
                $message->setDoctor($user->getDoctor());
            } else {
                $message->setPatient($user->getPatient());
            }

            $entityManager->persist($message);
            $entityManager->flush();
        }

        $messages = $adviceRequest->getMessages();
        return $this->render('message/conversation.html.twig', [
            'conv' => $adviceRequest,
            'messages' => $messages

        ]);
    }

}
