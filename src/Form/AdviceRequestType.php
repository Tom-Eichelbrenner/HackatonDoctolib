<?php

namespace App\Form;

use App\Entity\AdviceRequest;
use App\Entity\Patient;
use App\Entity\Speciality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdviceRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('topic', null, ['label' => 'Sujet'])
            ->add('pathology', EntityType::class, [
                'class' => Speciality::class,
                'choice_label' => 'category',
                'label' => 'Pathologie (si connue): ',
                'placeholder' => 'Je ne connais pas ma pathologie'
            ])
            ->add('problem', null, ['label' => 'Je décris mon problème: '])
            /**->add('patient', EntityType::class, [
                'class' => Patient::class,
                'choice_label' => 'fullname'
            ])*/

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdviceRequest::class,
        ]);
    }
}
