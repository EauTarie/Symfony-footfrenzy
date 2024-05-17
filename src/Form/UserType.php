<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('lastname')
            ->add('firstname')
            ->add('username')
            ->add('avatar')
            ->add('workingLocation')
            ->add('studyingClass')
            ->add('favorite_role')
            ->add('pointsNumber')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('updated_at', null, [
                'widget' => 'single_text',
            ])
            ->add('lastLogged_at', null, [
                'widget' => 'single_text',
            ])
            ->add('warned_at', null, [
                'widget' => 'single_text',
            ])
            ->add('banned_at', null, [
                'widget' => 'single_text',
            ])
            ->add('is_verified')
            ->add('is_warned')
            ->add('is_banned')
            ->add('is_password_reset_requested')
            ->add('passwordNumberRequest')
            ->add('warnNumber')
            ->add('totalPointsEarned')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
