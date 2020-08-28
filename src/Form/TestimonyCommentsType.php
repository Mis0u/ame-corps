<?php

namespace App\Form;

use App\Form\Services\CommentBuilder;
use Symfony\Component\Form\AbstractType;
use App\Entity\Testimony;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestimonyCommentsType extends AbstractType
{
    private $commentBuilder;

    public function __construct(CommentBuilder $commentBuilder)
    {
        $this->commentBuilder = $commentBuilder;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->commentBuilder->addOptions($builder);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Testimony::class,
        ]);
    }
}
