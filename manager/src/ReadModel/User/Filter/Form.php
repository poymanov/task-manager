<?php

declare(strict_types=1);

namespace App\ReadModel\User\Filter;

use App\Model\User\Entity\User\Role;
use App\Model\User\Entity\User\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('name', TextType::class, ['required' => false, 'attr' => ['placeholder' => 'Name']])
            ->add('email', TextType::class, ['required' => false, 'attr' => ['placeholder' => 'Email']])
            ->add('status', ChoiceType::class, ['choices' => [
                'Wait' => User::STATUS_WAIT,
                'Active' => User::STATUS_ACTIVE,
                'Blocked' => User::STATUS_BLOCKED,
            ], 'required' => false, 'placeholder' => 'All statuses', 'attr' => ['onchange' => 'this.form.submit()']])
            ->add('role', ChoiceType::class, ['choices' => [
                'User' => Role::USER,
                'Admin' => Role::ADMIN,
            ], 'required' => false, 'placeholder' => 'All roles', 'attr' => ['onchange' => 'this.form.submit()']]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filter::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}