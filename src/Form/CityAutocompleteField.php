<?php

namespace App\Form;

use App\Entity\City;
use App\Services\Slugify;
use App\Repository\CityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CityAutocompleteField extends AbstractType
{


    public function __construct(private Slugify $slugify)
    {
        $this->slugify = $slugify;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => City::class,
            'placeholder' => 'Choisissez une ville',
            // 'choice_label' => 'name',

            'query_builder' => function (CityRepository $cityRepository) {
                return $this->slugify->slugify($cityRepository->createQueryBuilder('city'));
            },
            // 'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
