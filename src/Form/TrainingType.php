<?php

namespace App\Form;

use App\Entity\Trainings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                null,
                [
                    'label' => 'Name',
                    'attr' => [
                        'placeholder' => 'Name',
                        'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                    ],
                ]
            )
            ->add('image',
            null,
            [
                'label' => 'Image',
                'attr' => [
                    'placeholder' => 'Image',
                    'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                ],
            ])
            ->add('extra_costs',
            null,
            [
                'label' => 'Extra Costs',
                'attr' => [
                    'placeholder' => 'Extra Costs',
                    'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trainings::class,
        ]);
    }
}
