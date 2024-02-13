<?php

namespace App\Form;

use App\Entity\Address;
use App\Services\Slugify;
use App\Entity\Department;
use App\Form\CityAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AddressType extends AbstractType
{
    public function __construct(private Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('street_name', TextType::class, [
                'label' => 'Nom de rue',
                'attr' => [
                    'placeholder' => 'Rue de la Paix',
                    'class' => 'form-control my-2',
                ]
            ])
            ->add('street_number', TextType::class, [
                'label' => 'Numéro de rue',
                'attr' => [
                    'placeholder' => '42',
                    'class' => 'form-control my-2',
                ]
            ])
            ->add('city', CityAutocompleteType::class, [
                'attr' => [
                    'class' => 'form-control my-2',
                ],

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
