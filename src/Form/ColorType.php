<?php

namespace App\Form;

use App\Entity\Color;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ColorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name',TextType::class,[
            'label'=> 'Couleur',
            'required' => false, 
            'attr' => [
                'placeholder' => 'Ecrire ici le nom de la couleur'
            ] 
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Color::class,
        ]);
    }
    
}
