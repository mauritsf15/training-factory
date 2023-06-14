<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// collection type

use Symfony\Component\Form\Extension\Core\Type\CollectionType;

// role type

use App\Form\RoleType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',
                null,
                [
                    'label' => 'Username',
                    'attr' => [
                        'placeholder' => 'Username',
                        'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                    ],
                ]
            )
            ->add('firstname'
                , null,
                [
                    'label' => 'Firstname',
                    'attr' => [
                        'placeholder' => 'Firstname',
                        'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                    ],
                ]
            
            )
            ->add('lastname'
                , null,
                [
                    'label' => 'Lastname',
                    'attr' => [
                        'placeholder' => 'Lastname',
                        'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                    ],
                ]
            
            )
            ->add('birthdate'
                , null,
                [
                    'label' => 'Birth Date',
                    'attr' => [
                        'placeholder' => 'DD/MM/YYYY',
                        'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                    ],
                ]
            
            )
            ->add('hiringdate'
            , null,
            [
                'label' => 'Hiring Date',
                'attr' => [
                    'placeholder' => 'DD/MM/YYYY',
                    'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                ],
            ]
        
        )
            ->add('salary'
            , null,
            [
                'label' => 'Salary',
                'attr' => [
                    'placeholder' => 'Salary',
                    'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                ],
            ]
        
        )
            ->add('socialsecnumber'
            , null,
            [
                'label' => 'Social Number',
                'attr' => [
                    'placeholder' => 'Social Number',
                    'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                ],
            ]
        
        )
            ->add('street'
            , null,
            [
                'label' => 'Address',
                'attr' => [
                    'placeholder' => 'Address',
                    'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                ],
            ]
        
        )
            ->add('subscriptionamount'
            , null,
            [
                'label' => 'Subscription Amount',
                'attr' => [
                    'placeholder' => 'Subscription Amount',
                    'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                ],
            ]
        
        )
            ->add('password',
                null,
                [
                    'label' => 'Password',
                    'attr' => [
                        'placeholder' => 'Password',
                        'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                    ],
                ]
            )
            ->add('roles', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Roles',
                    'attr' => [
                        'placeholder' => 'Roles',
                        'class' => 'bg-neutral-100 flex my-2 p-2 border-2 border-neutral-200 rounded-sm shadow-lg',
                    ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
