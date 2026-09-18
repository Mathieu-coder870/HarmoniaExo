<?php

namespace App\Form;

use App\Entity\Album;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre de lalbum',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('pouch', null, [
                'label' => 'Pochette',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('releaseDate', null, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            // ->add('createdAt', null, [
            //     'widget' => 'single_text',
            //      'attr' => [
            //             'class' => 'form-control',
            //      ]
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
