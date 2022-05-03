<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
              'label'=> 'Nom du produit',
              'required' => false,
              'attr' => [
                'placeholder' => 'Ecrire ici le nom...'
              ]  
            ])
            ->add('price', MoneyType::class,[
                'label' => 'Prix du produit',
                'required' => false,
                'divisor' => 100
            ])
          ->add('ImagePath', TextType::class,[
            'label' => 'Image du produit',
            'required' => false,
            'attr' => [
                'placeholder' => 'ajouter le chemin de l\'image içi'
            ]
        ])
        ->add('style')
        ->add('season')
        ->add('color')
        ->add('size')
        ->add('quantity')
        ->add('created_at')
        ->add('category', EntityType::class,[
            'label' => 'Choisir la catégorie',
            'placeholder' => '--Choisir--',
            'class' => Category::class
        ])
        ->add('productSizes')
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}