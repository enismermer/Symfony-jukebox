<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,                      // Le champ est requis
                'label' => 'Email :',                    // Étiquette personnalisée
                'attr' => ['class' => 'form-control',],  // Ajoute la classe form-control de Bootstrap
                'label_attr' => ['style' => 'width:60% ; text-align: center;'],
                'constraints' => [
                    new Assert\Email([
                        'message' => "L'adresse email '{{ value }}' n'est pas valide.",
                    ]),
                ],
            ])
           
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mot de Passe :', 
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'error-password',
                    'class' => 'form-control'
                ],
                'required' => true,                     // Le champ est requis
                'label_attr' => ['style' => 'width:60% ; text-align: center;'],
                'constraints' => new Regex([
                    'pattern' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                    'message' => 'Veuillez entrer un mot de passe d\'au moins 8 caractères, au moins 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial.',
                ]),
            ])
            // Ajout du bouton de soumission avec le type SubmitType et classe Bootstrap 'btn' et 'btn-primary' avec 'attr'
            ->add('Submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => ['class' => 'btn btn-primary'],
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
