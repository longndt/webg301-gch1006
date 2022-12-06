<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Movie;
use App\Entity\Category;
use App\Entity\Director;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Movie Name',
                    'required' => true,
                    'attr' => [
                        'minlength' => 3,
                        'maxlength' => 20
                    ]
                ]
            )
            ->add('image')
            ->add(
                'date',
                DateType::class,
                [
                    'widget' => 'single_text'
                ]
            )
            ->add('revenue', MoneyType::class)
            ->add(
                'category',
                EntityType::class,
                [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'expanded' => true
                ]
            )
            ->add(
                'director',
                EntityType::class,
                [
                    'class' => Director::class,
                    'choice_label' => 'name'
                ]
            )
            ->add(
                'actors',
                EntityType::class,
                [
                    'class' => Actor::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true
                ]
            )
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
