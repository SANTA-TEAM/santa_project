<?php

namespace App\Form;

use App\Form\UserType;
use App\Entity\Message;
use App\Entity\Department;
use PHPUnit\Framework\Test;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', ChoiceType::class, [
                'label' => 'Objet',
                'choices' => [
                    'J\'aime le Père Noël' => 'love',
                    'J\'ai un problème avec le Père Noël' => 'issue',
                ],
                'attr' => [
                    'class' => 'form-control my-2',
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'placeholder' => 'Il était une fois...',
                    'class' => 'form-control my-2',
                    'rows' => 5,
                ],
            ])
            ->add('writer', UserType::class, [
                'label' => false,
            ]) //Imbriquation du formulaire user
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn bg-white text-secondary rounded-5 my-2 px-4 py-2 text-uppercase fw-bold',
                ],
            ]);

           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
