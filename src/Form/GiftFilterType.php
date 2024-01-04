<?php

namespace App\Form;

use App\Entity\Age;
use App\Entity\Category;
use App\Entity\Gift;
use App\Entity\Letter;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiftFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => 'Catégorie',
                'required' => false,
                'attr' => [
                    'class' => 'form-control my-2 w-50',
                ]
            ])
            ->add('age', EntityType::class, [
                'class' => Age::class,
                'choice_label' => 'age',
                'placeholder' => 'Age',
                'required' => false,
                'attr' => [
                    'class' => 'form-control my-2 w-50',
                ]
            ])
            ->add('order', ChoiceType::class, [
                'choices' => [
                    'Age croissant' => 'Age_ASC',
                    'Age décroissant' => 'Age_DESC',
                    'Catégorie : A-Z' => 'Cat_ASC',
                    'Catégorie : Z-A' => 'Cat_DESC'
                ],
                'placeholder' => 'Trier par',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control my-2 w-50',
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gift::class,
            'csrf_protection' => false,
        ]);
    }
}
