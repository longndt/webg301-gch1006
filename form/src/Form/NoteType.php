<?php

namespace App\Form;

use App\Entity\Note;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //các input trong form sẽ tự động
            //được tạo theo attribute của entity
            //nếu cần bổ sung phần option hoặc validation 
            //thì cần khai báo đầy đủ cho từng input của form
            ->add(
                'title',
                TextType::class,
                [
                    //'required' => true,  //nullable == false
                    'required' => false,  //nullable == true
                    'label' => 'Tiêu đề',
                    'attr' => [
                        'minlength' => 5,
                        'maxlength' => 50
                    ]
                ]
            )
            ->add('content')
            //nếu update entity (bảng) sau khi đã tạo form
            //thì cần bổ sung các input thủ công
            ->add(
                'deadline',
                DateType::class,
                [
                    'required' => true,
                    'label' => 'Deadline hoàn thành',
                    'widget' => 'single_text'  //input type="date" (HTML)
                ]
            )
            ->add('quantity', IntegerType::class,
            [
                'attr' => [
                    'min' => 1,
                    'max' => 10
                ]
            ])
            ->add('money', MoneyType::class,
            [
                'currency' => 'USD'
            ])
            ->add('category', ChoiceType::class,
            [
                'choices' => [
                    // label (view) => value (DB)
                    'Study' => 'Học tập',
                    'Work' => 'Công việc',
                    'Personal' => 'Personal',
                    'Family' => 'Family',
                    'Friend' => 'Friend'
                ],
                'expanded' => true,    
                'multiple' => false 
                /*
                    set kiểu hiển thị (lựa chọn) trong form
                    1A) Drop-down list - single choice (mặc định)
                    'expanded' => false
                    'multiple' => false
                    1B) Drop-down list - multiple choice (giữ phím CTRL để chọn nhiều)
                    'expanded' => false
                    'multiple' => true
                    2) Radio button
                    'expanded' => true
                    'multiple' => false
                    3) Checkbox
                    'expanded' => true
                    'multiple' => true
                */
            ])
            //add bổ sung nút Submit trong form 
            ->add('Create', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
