<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sexe',  ChoiceType::class, [
                'choices'  => [
                    'Female' => 'Female',
                    'Male' => 'Male',
                ],
            ])
            ->add('reservedAt', DateType::class, ['widget' => 'single_text',])
            ->add('leaveAt', DateType::class, ['widget' => 'single_text',])
            ->add('status')
            ->add('bed')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
