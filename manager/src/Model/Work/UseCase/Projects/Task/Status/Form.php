<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Status;

use App\Model\Work\Entity\Projects\Task\Status;
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
            ->add('status', ChoiceType::class, ['choices' => [
                'New' => Status::NEW,
                'Working' => Status::WORKING,
                'Need Help' => Status::HELP,
                'Checking' => Status::CHECKING,
                'Rejected' => Status::REJECTED,
                'Done' => Status::DONE,
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
        return 'status';
    }
}