<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fistName')
            ->add('lastName')
            ->add('userName')
            ->add('email')
            ->add('title',  ChoiceType::class, [
                'choices'  => [
                    'Mr' => 'Mr',
                    'MM' => 'MM',
                    'Dr' => 'Dr',
                ],
            ])
            ->add('post',  ChoiceType::class, [
                'choices'  => [
                    'Doctor' => 'Doctor',
                    'Nurse' => 'Nurse',
                ],
            ])
            ->add('phone')
//            ->add('roles')
//            ->add('createdAt')
//            ->add('updatedAt')
            ->add('service')
            ->add('password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
