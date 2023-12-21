<?php

namespace App\Form;

use App\Entity\Age;
use App\Entity\Gift;
use App\Entity\Letter;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('created_at')
            ->add('updated_at')
            ->add('age', EntityType::class, [
                'class' => Age::class,
'choice_label' => 'id',
            ])
            ->add('creator', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('letters', EntityType::class, [
                'class' => Letter::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gift::class,
        ]);
    }
}
