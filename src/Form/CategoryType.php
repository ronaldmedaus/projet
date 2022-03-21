<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
            'label'=> 'Nom de la catégorie',
            'required' => false, 
            'attr' => [
                'placeholder' => 'Ecrire ici le nom'
            ] 
            ])
            ->add('imagePath', TextType::class,[
                'label' => 'Image de la catégorie',
                'required' => false,
                'attr' => [
                    'placeholder' => 'ajouter le chemin de l\'image içi'
                ]  
            ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
