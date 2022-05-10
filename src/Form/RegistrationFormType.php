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
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Rollerworks\Component\PasswordStrength\Validator\Constraints\PasswordStrength;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre nom complet',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez votre nom complet svp',
                    ]),
                ],
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Votre téléphone',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez votre téléphone svp',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez votre e-mail svp',
                    ]),
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Votre Adresse',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez votre adresse svp',
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Acceptez nos CGU svp',
                    ]),
                ],
            ])

            /*- ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'option' => ['attr' => ['class' => 'password-field']],
                'mapped' => false,
                'label' => 'Mot de passe',
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Mot de passe*'
                ],

                'constraints' => [
                    new PasswordStrength(
                        [
                            'minLength'  => 8,
                            'tooShortMessage' => 'le mot de passe doit contenir au moins 8 caractères',
                            'minStrength' => 4,
                            'message' => 'le mot de passe doit contenir au moins une lettre majuscule, une lettrre minuscule, un chiffre et un caractère spécial.',
                        ]
                    )
                ],

                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Mot de passe*'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Vous devez renseigner un mot de passe',
                        ]),
                    ],
                ],

                'second_options' => [
                    'label' => 'Confirmer votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmer votre mot de passe*'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Vous devez confirmer votre mot de passe',
                        ]),
                    ],
                ],
            ]);*/

            // Mon code Original
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'required' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez un mot de passe svp',
                    ]),
                    //new Length([
                    //    'min' => 6,
                    //  'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    //'max' => 4096,
                    //]),
                    new PasswordStrength([
                        'minLength'  => 8,
                        'tooShortMessage' => 'le mot de passe doit contenir au moins 8 caractères',
                        'minStrength' => 4,
                        'message' => 'le mot de passe doit contenir au moins une lettre majuscule, une lettrre minuscule, un chiffre et un caractère spécial.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
