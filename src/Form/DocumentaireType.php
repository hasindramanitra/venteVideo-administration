<?php

namespace App\Form;

use App\Entity\Documentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DocumentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=>3, 'max'=>50])
                ],
                'label'=>'Entrez le titre du documentaire',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('anneeDeSortie', TextType::class, [
                'constraints'=>[
                    new Assert\Length(['min'=>4]),
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez l\'année de sortie',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('duration', TextType::class, [
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=>6, 'max'=>50])
                ],
                'label'=>'Entrez la durée',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('price', MoneyType::class, [
                'constraints'=>[
                    new Assert\Positive(),
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez le prix',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=>10])
                ],
                'label'=>'Entrez la description',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('documentaireImageFile', VichImageType::class, [
                'label'=>'Entrez la photo du documentaire'
            ])
            ->add('Submit', SubmitType::class, [
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
            'data_class' => Documentaire::class,
        ]);
    }
}
