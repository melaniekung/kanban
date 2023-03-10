<?php

namespace App\Form;

use App\Entity\TaskModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'To Do' => 'todo',
                    'In Progress' => 'progress',
                    'Blocked' => 'blocked',
                    'Done' => 'done',
                    'Archive' => 'archive',
                    'Delete' => 'delete'
                ]
            ])
            ->add('notes', TextareaType::class)
            ->add('tags', TextType::class)
            ->add('duedate', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TaskModel::class,
            'data_class' => null,
        ]);
    }
}

?>