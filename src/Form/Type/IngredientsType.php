<?php

namespace App\Form\Type;

use App\Entity\Ingredient;
use App\Form\EventListener\AddNameFieldSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class IngredientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
       
        ->add('nomIngredient', TextType::class, [
            //placeholder
            'help' => 'farine, lait',
        ])
        ->add('quantite', IntegerType::class, [
            'help' => 'mettez un chiffre',
        ])
        ->add('mesure', TextType::class, [
            'help' => 'kilogramme, gramme, cuillère à soupe, cuillère à café, millilitre, litre',
        ]);

    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}