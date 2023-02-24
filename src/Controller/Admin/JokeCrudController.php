<?php

namespace App\Controller\Admin;

use App\Entity\Joke;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JokeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Joke::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('joke'),
            TextField::new('category'),
        ];
    }
    
}
