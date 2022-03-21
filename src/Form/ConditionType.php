<?php

namespace App\Form;

use App\Entity\Condition;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ConditionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title',TextType::class,[
        'label'=> 'Nom du CGV',
        'required' => false, 
        'attr' => [
            'placeholder' => 'Ecrire ici le titre du CGV'
        ] 
        ])
        ->add('content', CKEditorType::class,[
            'label' => 'texte',
            'required' => false,
            'attr' => [
                'placeholder' => 'ajouter votre texte içi'
            ]  
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Condition::class,
        ]);
    }
}
