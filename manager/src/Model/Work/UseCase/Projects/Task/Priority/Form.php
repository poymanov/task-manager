<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Priority;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('priority', ChoiceType::class, ['choices' => [
                'Low' => 1,
                'Normal' => 2,
                'High' => 3,
                'Extra' => 4,
            ], 'attr' => ['onchange' => 'this.form.submit()']]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Command::class,
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'priority';
    }
}