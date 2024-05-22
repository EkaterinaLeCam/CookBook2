<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ingredient::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nomIngredient')->setHelp('Veuillez entrer le nom de l\'ingrédient'),
            IntegerField::new('quantite')->setHelp('Veuillez entrer la quantité'),
            TextField::new('mesure')->setHelp('Veuillez entrer l\'unité de mesure, par exemple, kilogramme, gramme, litre, etc.'),
            
        ];
    }
    
}
