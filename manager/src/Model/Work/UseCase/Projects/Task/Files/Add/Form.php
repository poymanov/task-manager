<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Files\Add;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('files', FileType::class, [
                'mapped' => false,
                'multiple' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please select files'
                    ])
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Command::class
        ]);
    }
}