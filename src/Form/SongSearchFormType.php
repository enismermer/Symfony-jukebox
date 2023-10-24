<?php

namespace App\Form;

use App\Entity\Music;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SongSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', SearchType::class, [
            'required' => true,                      // Le champ est requis
            'label' => 'Titre :',                    // Étiquette personnalisée
            'attr' => [
                'class' => 'form-control',           // Ajoute la classe form-control de Bootstrap
                'placeholder' => 'Rechercher'        // Ajoute le placeholder 'Rechercher'
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Music::class,
        ]);
    }
}
