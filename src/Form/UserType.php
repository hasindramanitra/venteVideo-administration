<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullname', TextType::class, [
                'constraints'=>[
                    new NotBlank(),
                    new Length(['min'=>3])
                ],
                'label'=>'Entrez votre Nom',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('lastname', TextType::class, [
                'constraints'=>[
                    new NotBlank(),
                    new Length(['min'=>3])
                ],
                'label'=>'Entrez votre Prénom',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints'=>[
                    new NotBlank()
                ], 
                'label'=>'Entrez l\'email du nouveau utilisateur',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('adress', TextType::class, [
                'constraints'=>[
                    new NotBlank(),
                    new Length(['min'=>10])
                ],
                'label'=>'Entrez votre Adresse',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit être plus de  {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ], 
                'label'=>"Entrez le mot de passe du nouveau utilisateur",
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Enregistrer',
                'attr'=>[
                    'class'=>'btn btn-success'
                ]
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
