<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Rollerworks\Component\PasswordStrength\Validator\Constraints\PasswordStrength;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name',TextType::class,[
            'label' => 'Votre nom complet',
            'required' => false
        ])
        ->add('telephone',TextType::class,[
            'label' => 'Votre téléphone',
            'required' => false
        ])
        ->add('email',EmailType::class,[
            'label' => 'Adresse email',
            'required' => false
        ])
        ->add('adresse',TextType::class,[
            'label' => 'Votre Adresse',
            'required' => false
        ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Acceptez nos CGU svp',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez un mot de passe svp!',
                    ]),

                    //new Length([
                    //    'min' => 6,
                      //  'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        //'max' => 4096,
                    //]),
                    new PasswordStrength ([ 
                        'minLength'  => 8,
                        'tooShortMessage' => 'le mot de passe doit contenir au moins 8 caractères',
                        'minStrength' => 4,
                        'message' => 'le mot de passe doit contenir au moins une lettre majuscule, une lettrre minuscule, un chiffre et un caractère spécial.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
