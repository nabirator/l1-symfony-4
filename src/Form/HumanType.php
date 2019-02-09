<?php

namespace App\Form;

use App\Entity\Human;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HumanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('age')
            ->add('height')
            ->add('weight')
            ->add('gender')
            ->add('dob', DateType::class, [
                'years' => range(1917, date('Y'))
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Human::class,
        ]);
    }
}
