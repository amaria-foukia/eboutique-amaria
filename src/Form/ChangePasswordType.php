<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=> 'Votre email',
                'disabled'=>true
            ])
            ->add('firstname', TextType::class, [
                'label'=> 'Votre prenom',
                'disabled'=>true
            ])
            ->add('lastname', TextType::class, [
                'label'=> 'Votre nom',
                'disabled'=>true
            ])
            ->add('old_password', PasswordType::class, [
                'mapped'=>false,
                'label'=>'Votre ancien mot de passe',
                'attr'=>[
                    'placeholder'=> 'Saisir votre ancien mot de passe'
                ]
            ])
            ->add('new_password', RepeatedType::class,
                [
                    'type'=> PasswordType::class,
                    'mapped'=>false,
                    'invalid_message'=> 'Attention, les mots de passes ne sont pas identiques',
                    'label'=>'Votre nouveau mot de passe',
                    'constraints'=> new Length([
                        'min'=> 2, 
                        'max'=> 60
                    ]),
                    'required'=> true,
                    'first_options'=> ['label'=>'Votre nouveau mot de passe',
                    'attr'=>[
                        'placeholder'=> 'Saisir votre nouveau mot de passe'
                    ]
                ],
                    'second_options'=> ['label'=>'Confirmation du nouveau mot de passe',
                    'attr'=>[
                        'placeholder'=> 'Confirmer votre nouveau mot de passe'
                    ]
                ]
                ]
            )
            ->add('submit',SubmitType::class,
                [
                    'label'=>'Mettre à jour' 
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
