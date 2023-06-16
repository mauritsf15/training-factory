<?php

namespace App\Form;

use App\Entity\Classes;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Trainings;

class AddClassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Trainings', EntityType::class, [
                'class' => Trainings::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'label' => '‎',
            ])
            ->add('date')
            ->add('duration')
            ->add('max_users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classes::class,
        ]);
    }
}
