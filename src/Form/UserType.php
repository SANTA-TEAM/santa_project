<?php

namespace App\Form;

use App\Entity\User;
use App\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'John',
                    'class' => 'form-control my-2',
                ]
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Doe',
                    'class' => 'form-control my-2',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'attr' => [
                    'placeholder' => 'john@doe.com',
                    'class' => 'form-control my-2',
                ]
            ])
            ->add('address', AddressType::class, [
                'label' => false
            ]); //Imbriquation du formulaire address;           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
