<?php

namespace App\Form;
use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class,[
                'attr'=>[
                'placeholder'=>'Entrer le titre',
                'class'=> 'form-control',


                ]
            ])
            ->add('minicontenu',TextareaType::class,[
                'attr'=>[
                    'placeholder'=>'Entrer le mini_contenu',
                    'class'=> 'mini-controle'

                ]
            ])
            ->add('maxcontenu',TextareaType::class,[
                'attr'=>[
                    'placeholder'=>'Entrer le mini_contenu',
                    'class'=> 'form-control'

                ]
            ])

            ->add('dateevent',DateTimeType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])

            ->add('image',FileType::class)


            ->add('address',TextType::class,[

                'attr'=>[

                    'placeholder'=>'Entrer l`address',
                    'class'=> 'form-control'

                ]
            ])
            ->add('phone',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Entrer le numero de telephone',
                    'class'=> 'form-control'

                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
