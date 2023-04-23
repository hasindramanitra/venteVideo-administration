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

class UserShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullname', TextType::class, [
                'label'=>'Votre Nom',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('lastname', TextType::class, [

                'label'=>'Votre Prénom',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('email', EmailType::class, [ 
                'label'=>'Votre email',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('adress', TextType::class, [
                'label'=>'Votre Adresse',
                'attr'=>[
                    'class'=>'form-control'
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
