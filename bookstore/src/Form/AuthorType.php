<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Author name',
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 30
                ]
            ])
            ->add('age', IntegerType::class,
            [
                'label' => 'Author age',
                'attr' => [
                    'min' => 15,
                    'max' => 80
                ]
            ])
            ->add('address',TextType::class,
            [
                'label' => 'Author address',
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 50
                ]
            ])
            ->add('image' ,TextType::class,
            [
                'label' => 'Author image',
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            //Nếu đã add Author trong Book
            //thì không cần add theo chiều ngược lại
            //->add('books')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
