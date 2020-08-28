<?php

namespace App\Form\Services;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class CommentBuilder
{
    public function addOptions($builder)
    {
        return $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre email *'
                ]
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre nom *'
                ]
            ])
            ->add('content', CKEditorType::class, [
                'config_name' => 'client_config',
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre commentaire'
                ]
            ]);
    }
}
