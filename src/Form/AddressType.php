<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Address;

use App\Entity\Department;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('street_name', TextType::class, [
                'label' => 'Nom de la rue',
                'attr' => [
                    'placeholder' => 'Rue de la Paix',
                    'class' => 'form-control m-2',
                ]
            ])
            ->add('street_number', TextType::class, [
                'label' => 'Numéro de rue',
                'attr' => [
                    'placeholder' => '42',
                    'class' => 'form-control m-2',
                ]
            ])
            ->add('department', EntityType::class, [
                'label' => 'Département',
                'class' => Department::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control m-2',
                ],
                'mapped' => false,
            ])
            // ->add('city', EntityType::class, [
            //     'class' => City::class,
            //     'label' => 'Ville',
            //     'choice_label' => 'name',
            //     'attr' => [
            //         'placeholder' => '42',
            //         'class' => 'form-control m-2',
            //     ]
            // ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $address = $event->getData();
            $form = $event->getForm();
            
            if (!$address) {
                return;
            }
            
            // $department = $address->getDepartment();

            // if ($department) {
            //     $form->add('city', EntityType::class, [
            //         'label' => 'Ville',
            //         'class' => City::class,
            //         'choice_label' => 'name',
            //         'attr' => [
            //             'class' => 'form-control m-2',
            //         ],
            //         'query_builder' => function ($city) use ($department) {
            //             return $city->createQueryBuilder('c')
            //                 ->where('c.department = :department')
            //                 ->setParameter('department', $department->getAddress()->getDepartment());
            //         },
            //         'mapped' => false,
            //     ]);
            // }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
