<?php

namespace App\Controller\Admin;

use App\Entity\Rating;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RatingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rating::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id') -> hideOnForm(),
            AssociationField::new('user', 'User') // Je définis le nom de la propriété
                ->setFormTypeOptions([
                    'choice_label' => 'email' // Je reprends la colonne 'email' de la table "user"
                ]),
            AssociationField::new('music', 'Music') // Je définis le nom de la propriété
                ->setFormTypeOptions([
                    'choice_label' => 'title' // Je reprends la colonne 'title' de la table "music"
                ]),
            TextField::new('comment'),
            IntegerField::new('rating'),
            DateTimeField::new('created_at') -> hideOnForm(),
            DateTimeField::new('updated_at') -> hideOnForm()
        ];
    }
    
}
