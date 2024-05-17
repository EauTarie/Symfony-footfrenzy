<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('updated_at', null, [
                'widget' => 'single_text',
            ])
            ->add('begin_at', null, [
                'widget' => 'single_text',
            ])
            ->add('finished_at', null, [
                'widget' => 'single_text',
            ])
            ->add('is_waiting')
            ->add('is_pending')
            ->add('is_twoVsTwo')
            ->add('blueTeamScore')
            ->add('redTeamScore')
            ->add('winner')
            ->add('winningReason')
            ->add('invite_link')
            ->add('is_friendly')
            ->add('id_blueTeam', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'id',
            ])
            ->add('id_redTeam', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
