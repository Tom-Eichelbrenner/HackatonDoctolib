<?php

namespace App\Form;

use App\Entity\Region;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add(
                'plainPassword', PasswordType::class, [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank(
                            [
                                'message' => 'Please enter a password',
                            ]
                        ),
                        new Length(
                            [
                                'min' => 6,
                                'minMessage' => 'Your password should be at least {{ limit }} characters',
                                // max length allowed by Symfony for security reasons
                                'max' => 4096,
                            ]
                        ),
                    ],
                ]
            )
            ->add(
                'fName', null, [
                'label' => 'Prénom',
                'mapped' => false
                ]
            )
            ->add(
                'lName', null, [
                'label' => 'Nom',
                'mapped' => false
                ]
            )
            ->add(
                'birthDate', DateType::class, [
                'mapped' => false,
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => "js-datepicker",
                    'data-date-format' => "yyyy/mm/dd",
                ],
            ])
            ->add(
                'region', EntityType::class, [
                    'class' => Region::class,
                    'choice_label' => 'name',
                    'by_reference' => false,
                    'label' => 'Région',
                    'mapped' => false
                ]
            )
            ->add(
                'sexe', ChoiceType::class, [
                'choices' => [
                    'Un homme' => 'Homme',
                    'Une femme' => 'Femme',
                    'Un helicoptère d\'attaque' => 'Un helicoptère d\'attaque',
                    'Une teub géante' => 'Une teub géante',
                ],
                'label' => 'Je suis : ',
                'mapped' => false]
            )
        //            ->add('pathology', null,
        //                'label'    => "On m'a diagnostiqué une (ou plusieurs) maladies.",
        //                'mapped'=>false)
            ->add(
                'pathology', null, [
                'label' => "Mes maladies diagnostiquées (ne pas remplir si nul)",
                'mapped' => false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => User::class,
            ]
        );
    }
}
