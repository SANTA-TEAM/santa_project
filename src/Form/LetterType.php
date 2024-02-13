<?php

namespace App\Form;

use App\Entity\Letter;
use App\Form\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class LetterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Objet',
                'attr' => [
                    'class' => 'form-control my-2'
                ]
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'class' => 'form-control my-2'
                ]
            ])
            ->add('writer', UserType::class, [
                    'label' => false,
                    'attr' => [
                        'class' => 'form-control my-2 h-100'
                    ]
                ]
            )
            ->add('submit', SubmitType::class, [
                'label' => 'Poster ma lettre',
                'attr' => [
                    'class' => 'btn bg-white text-secondary rounded-5 my-2 px-4 py-2 text-uppercase fw-bold',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Letter::class,
        ]);
    }
}
