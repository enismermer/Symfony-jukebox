<?php

namespace App\Form;

use App\Entity\Music;
use App\Entity\Rating;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RatingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('music', EntityType::class, [
                'required' => true,
                'class' => Music::class,
                'choice_label' => 'title',
                'label'=> 'Choisissez une musique :',
                'label_attr' => ['style' => 'width:15em; padding-bottom:10px; color:white;'],
                'attr' => [
                    'style' => 'padding:10px; width:100%;',
                ],
            ])
            ->add('rating', ChoiceType::class, [
                'label' => 'Note :',
                'label_attr' => [
                    'style' => 'padding-right:10px; color:white;'
                ],
                'choices' => [
                    '1 étoile'  => 1,
                    '2 étoiles' => 2,
                    '3 étoiles' => 3,
                    '4 étoiles' => 4,
                    '5 étoiles' => 5,
                ],
            ])
            ->add('comment', TextareaType::class, [
                'required' => true,
                'label' => 'Commentaire :',
                'label_attr' => [
                    'style' => 'padding-bottom:10px; color:white;'
                ],
                'attr' => [
                    'style' => 'padding:10px 10px 60px 10px; width:100%;',
                    'placeholder' => 'Entrez votre commentaire',
                ],
            ])
            // Ajout du bouton de soumission avec le type SubmitType et classe Bootstrap 'btn' et 'btn-primary' avec 'attr'
            ->add('Submit', SubmitType::class, [
                'label' => 'Noter',
                'attr' => [
                    'class' => 'btn btn-success'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rating::class,
        ]);
    }
}
