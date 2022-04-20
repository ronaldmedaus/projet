<?php

namespace App\Form;

use App\Dictionary\Legals;
use App\Entity\Condition;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ConditionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title',ChoiceType::class,[
        'label'=> 'Nom du document',
        'disabled' => true, 
        'required' => false, 
        'choices' => [
            Legals::CONDITIONS_GENERALES_DE_VENTES => Legals::CONDITIONS_GENERALES_DE_VENTES,
            Legals::MENTIONS_LEGALES => Legals::MENTIONS_LEGALES,
            Legals::PROTECTIONS_DES_DONNEES => Legals::PROTECTIONS_DES_DONNEES,
            Legals::CONDITIONS_GENERALES_UTILISATIONS => Legals::CONDITIONS_GENERALES_UTILISATIONS,
            Legals::RETOUR_REMBOURSEMENT => Legals::RETOUR_REMBOURSEMENT,

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
