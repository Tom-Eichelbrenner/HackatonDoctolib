<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Patient;
use App\Entity\User;
use App\Form\DoctorRegistrationFormType;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{

    /**
     * @Route("/register", name="app_register")
     */
    public function register(){
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        if (isset($_POST['submit'])){
            if ($_POST['role'] === 'doctor'){
                return $this->redirectToRoute('app_register_doctor');
            }else{
                return $this->redirectToRoute('app_register_patient');
            }
        }

        return $this->render('registration/registerrole.html.twig');
    }
    /**
     * @Route("/register/patient", name="app_register_patient")
     */
    public function registerpatient(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator): Response
    {
        $user = new User();
        $patient = new Patient();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_PATIENT']);
            $user->setPatient($patient);
            $patient->setDisease($form->get('pathology')->getData());
            $patient->setRegion($form->get('region')->getData());
            $patient->setBdate($form->get('birthDate')->getData());
            $patient->setLName($form->get('lName')->getData());
            $patient->setFName($form->get('fName')->getData());
            $patient->setSex($form->get('sexe')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patient);
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render(
            'registration/registerpatient.html.twig', [
                'registrationForm' => $form->createView(),
            ]
        );
    }
    /**
     * @Route("/register/doctor", name="app_register_doctor")
     */
    public function registerdoctor(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator): Response
    {
        $user = new User();
        $doctor = new Doctor();
        $form = $this->createForm(DoctorRegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_DOCTOR']);
            $doctor->setFName($form->get('fName')->getData());
            $doctor->setLName($form->get('lName')->getData());
            $doctor->setRegion($form->get('region')->getData());
            $doctor->setPhone($form->get('phone')->getData());
            $doctor->setSpeciality($form->get('pathology')->getData());
            $entityManager = $this->getDoctrine()->getManager();

            $user->setDoctor($doctor);
            $entityManager->persist($user);
            $entityManager->persist($doctor);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render(
            'registration/registerdoctor.html.twig', [
                'registrationForm' => $form->createView(),
            ]
        );
    }
}
