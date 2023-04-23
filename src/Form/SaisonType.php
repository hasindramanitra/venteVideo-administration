<?php

namespace App\Form;

use App\Entity\Saison;
use App\Entity\Serie;
use App\Repository\GenreRepository;
use App\Repository\SerieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SaisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints'=>[
                    new Assert\Length(['min'=>3, 'max'=>50]),
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez la saison',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('durationEachEpisode', TextType::class, [
                'constraints'=>[
                    new Assert\Length(['min'=>3]),
                    new Assert\NotBlank()
                ],
                'label'=>'Entrez la durée d\'une épisode de cette saison',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('serie', EntityType::class, [
                'class'=>Serie::class,
                'label'=>'Sélectionner la serie  à qui appartient cette saison',
                'query_builder'=> function(SerieRepository $r){
                    return $r->createQueryBuilder('i')
                        ->orderBy('i.id', 'ASC');
                },
                'choice_label'=>'title',
                'multiple'=>false,
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
            'data_class' => Saison::class,
        ]);
    }
}
