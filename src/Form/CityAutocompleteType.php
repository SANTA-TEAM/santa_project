<?php

namespace App\Form;


use App\Entity\City;
use App\Services\Slugify;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CityAutocompleteType extends AbstractType
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
      'label' => 'Ville',
      'choice_label' => function ($city) {
        return $this->slugify->slugify($city->getName()) . ' (' . $city->getZipCode() . ')';
    }
    ]);
  }

  public function getParent(): string
  {
    return BaseEntityAutocompleteType::class;
  }
}
