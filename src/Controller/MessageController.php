<?php

namespace App\Controller;


use App\Entity\AdviceRequest;
use Symfony\Component\Routing\Annotation;
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

        if ($this->getUser()->getPatient() != null) {
            $patient = $this->getUser()->getPatient();
            $active = [];
            $requests = $patient->getAdviceRequests();
            foreach ($requests as $request){
                if ($request->getDoctor() !=null){
                    array_push($active,$request);
                }
            }

            return $this->render('message/indexpatient.html.twig', [
                'controller_name' => 'MessageController',
                'patient' => $patient,
                'requests' => $active
            ]);
        } else {
            $doctor = $this->getUser()->getDoctor();
            $requests = $doctor->getAdviceRequests();

            return $this->render('message/indexdoctor.html.twig', [
                'controller_name' => 'MessageController',
                'doctor' => $doctor,
                'requests' => $requests
            ]);
        }
    }


    /**
     * @Route("/answer/{id}", name="answer", requirements={"id":"\d+"})
     */
    public function answer(AdviceRequest $adviceRequest, Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $adviceRequest->setIsViewed(true);
        $id = $adviceRequest->getId();
        $adviceRequest->setDoctor($this->getUser()->getDoctor());
        $entityManager->persist($adviceRequest);
        $entityManager->flush();
        return $this->redirectToRoute('conversation_show',['id' => $id]);

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
