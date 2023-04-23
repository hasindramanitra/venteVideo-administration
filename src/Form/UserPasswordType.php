<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword',PasswordType::class , [
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=>8, 'max'=>255])
                ],
                'label'=>'Enter your last password',
                'attr'=>[
                    'class'=>'form-control'
                ]
                
            ])
            ->add('newPassword',RepeatedType::class ,[
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=>8, 'max'=>255])
                ],
                'type'=>PasswordType::class,
                'first_options'=>[
                    'label'=>'Enter your  new password',
                    'attr'=>[
                        'class'=>'form-control'
                    ]
                ],
                'second_options'=>[
                    'label'=>'confirm your new password',
                    'attr'=>[
                        'class'=>'form-control'
                    ]
                ],
                'invalid_message'=>'your new password are not the same'
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'change your password',
                'attr'=>[
                    'class'=>'btn btn-info'
                ]
            ])
        ;
    }
}