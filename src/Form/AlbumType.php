<?php

namespace App\Form;

use App\Entity\Album;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre de lalbum',
            ])
            ->add('pouch', null, [
                'label' => 'Pochette'
            ])
            ->add('releaseDate', null, [
                'widget' => 'single_text'
            ])
            // ->add('createdAt', null, [
            //     'widget' => 'single_text'
            // ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'EP' => 'EP',
                    'Album' => 'Album',
                    'Single' => 'Single'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-primary mt-3',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
