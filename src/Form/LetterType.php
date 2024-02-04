<?php

namespace App\Form;

use App\Entity\Gift;
use App\Entity\User;
use App\Entity\Letter;
use App\Form\UserType;
use Faker\Provider\ar_EG\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                'attr' => [
                    'class' => 'form-control my-2'
                ]
            ])
            ->add('text', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control my-2'
                ]
            ])
            ->add(
                'writer',
                UserType::class, [
                    'label' => false,
                    'attr' => [
                        'class' => 'form-control my-2'
                    ]
                ]
            )
            // ->add('gift', EntityType::class, [
            //     'class' => Gift::class,
            //     'choice_label' => 'name',
            //     'multiple' => true,
            //     // 'expanded' => true,
            //     // 'by_reference' => false,
            // ])
            ->add('submit', SubmitType::class, [
                'label' => 'Poster ma lettre',
                'attr' => [
                    'class' => 'btn bg-white text-secondary rounded-5 m-2 px-4 py-2 text-uppercase fw-bold',
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
