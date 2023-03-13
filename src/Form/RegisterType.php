<?php

namespace App\Form;
use App\Entity\User;
// j'oublie pas d'importer mes chemins email et password
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class)
        ->add('password', PasswordType::class, [
            'required' => true,
            'label' => 'Mot de Passe',
            'constraints' => [
                new Regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', 
                "Veuillez entrer un mot de passe de 8 caractères minimum, au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial.")
            ],
        ])
        ->add('Submit', SubmitType::class)
        ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
