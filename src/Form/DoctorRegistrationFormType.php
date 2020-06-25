<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Region;
use App\Entity\Speciality;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DoctorRegistrationFormType extends AbstractType
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
            ->add('fName', null, [
                'label' => 'Prénom',
                'mapped' => false
            ])
            ->add('lName', null, [
                'label' => 'Nom',
                'mapped' => false
            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'mapped' => false,
                'choice_label' => 'name',
                'by_reference' => false,
                'label' => 'Votre région'
            ])
            ->add('phone', null, [
                'label' => 'Votre numéro de téléphone',
                'mapped' => false
            ])
            ->add('pathology', EntityType::class, [
                'class' => Speciality::class,
                'choice_label' => 'category',
                'mapped'=>false,
                'label' => 'Mon secteur d\'activité: ',
                'placeholder' => 'Sélectionnez une spécialité'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
