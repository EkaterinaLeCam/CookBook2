<?php

namespace App\Controller\Admin;

use App\Entity\Recette;
use App\Form\Type\IngredientsType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recette::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            IdField::new('id')->hideOnForm(),
            TextField::new('nomRecette')->setHelp('Veuillez entrer le nom du plat'),
            AssociationField::new('nomCategorie')->setHelp('Veuillez choisir une catégorie'),
            CollectionField::new('Ingredient')->setEntryType(IngredientsType::class),
            TextField::new('pays')->setHelp('Veuillez entrer le pays d\'origine du plat'),
            TextField::new('tempsDePreparation')->setHelp('Temps de préparation, par ex. 30 min'),
            TextField::new('tempsDeCuisson')->setHelp('Temps de cuisson, par ex. 1h30'),
            TextField::new('difficulte')->setHelp('Niveau de difficulté : difficile, moyen, facile'),
            TextareaField::new('preparation')->setHelp('Détails de la préparation'),
            
          
           
        ];
    }
    
}
