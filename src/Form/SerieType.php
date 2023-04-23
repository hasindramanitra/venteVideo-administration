<?php

namespace App\Form;

use App\Entity\Serie;
use App\Repository\GenreRepository;
use App\Entity\Genre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints'=>[
                    new Assert\Length(['min'=>3, 'max'=>50]),
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez le titre',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'constraints'=>[
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez la description',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('authors', TextType::class, [
                'constraints'=>[
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez les acteurs principales',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('anneeDeSortie', TextType::class, [
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=>4])
                ],
                'label'=>'Entrez l\année de sortie du serie',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('priceBySeason', MoneyType::class, [
                'constraints'=>[
                    new Assert\Positive(),
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez le prix d\une saison',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('serieImageFile', VichImageType::class, [
                'label'=>'Entrez la photo du serie'
            ])
            ->add('Genres', EntityType::class, [
                'class'=>Genre::class,
                'label'=>'Sélectionner les genres du serie',
                'query_builder'=> function(GenreRepository $r){
                    return $r->createQueryBuilder('i')
                        ->orderBy('i.id', 'ASC');
                },
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true
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
            'data_class' => Serie::class,
        ]);
    }
}
