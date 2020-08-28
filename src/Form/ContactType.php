<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add('email', EmailType::class, [
                'mapped' => false,
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre email *'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ ne peut être vide']),
                    new Email(['message' => "L'adresse indiqué n'est pas au bon format"]),
                ],
            ])
            ->add('name', TextType::class, [
                'mapped' => false,
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre nom *'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ ne peut être vide'])
                ],
            ])
            ->add('message', CKEditorType::class, [
                'mapped' => false,
                'config_name' => 'client_config',
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre commentaire'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ ne peut être vide'])
                ],
            ]);
    }
}
