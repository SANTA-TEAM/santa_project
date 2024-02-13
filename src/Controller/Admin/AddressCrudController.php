<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Services\Slugify;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AddressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Address::class;
    }

    public function __construct(private Slugify $slugify)
    {
    }


    public function configureFields(string $pageName): iterable
    {
        // yield AssociationField::new('city', 'Ville')
        //     ->formatValue(function ($entity) {
        //         return $this->slugify->slugify($entity->getCity()->getName()) . ' ' . $entity->getCity()->getZipCode();
        //     });
        yield AssociationField::new('city', 'Ville');
        yield TextField::new('street_number', 'N° de rue');
        yield TextField::new('street_name', 'Nom de rue');
    }
}
