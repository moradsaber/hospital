<?php

namespace App\Form;

use App\Entity\Bed;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postion',  ChoiceType::class, [
                'choices'  => [
                        'Porte' => 'Porte',
                        'Fenetre' => 'Fenetre',
                    ],
                'placeholder' => 'Choose a Bed Position',
            ])
            ->add('isOperationel')
            ->add('commentaire')
            ->add('room')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bed::class,
        ]);
    }
}
