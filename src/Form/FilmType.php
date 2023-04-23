<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Genre;
use App\Repository\GenreRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints'=>[
                    new Assert\Length(['min'=>3, 'max'=>50]),
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez le Titre',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('anneeDeSortie', TextType::class, [
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=>4])
                ],
                'label'=>'Entrez L\'année de sortie',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('duration', TextType::class, [
                'constraints'=>[
                    new Assert\Length(['min'=>3, 'max'=>50]),
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez La durée du film',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('price', MoneyType::class,[
                'constraints'=>[
                    new Assert\Positive(),
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez le prix du film',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('filmImageFile', VichImageType::class,[
                'label'=>'Photo du film'
            ] )
            ->add('Genres', EntityType::class, [
                'class'=>Genre::class,
                'label'=>'Sélectionner les genres du film',
                'query_builder'=> function(GenreRepository $r){
                    return $r->createQueryBuilder('i')
                        ->orderBy('i.id', 'ASC');
                },
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true
            ])
            ->add('submit', SubmitType::class,[
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
            'data_class' => Film::class,
        ]);
    }
}
