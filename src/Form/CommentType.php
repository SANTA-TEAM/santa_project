<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Comment;
use Faker\Provider\ar_EG\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Commentaire',
                'attr' => [
                    'placeholder' => 'Il était une fois...',
                    'class' => 'form-control m-2',
                    'rows' => 5,
                ],
            ])
            ->add('user_name', TextType::class, [
                'label' => 'Pseudo',
                'attr' => [
                    'placeholder' => 'John Doe',
                    'class' => 'form-control m-2',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn bg-white text-secondary rounded-5 m-2 px-4 py-2 text-uppercase fw-bold',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
