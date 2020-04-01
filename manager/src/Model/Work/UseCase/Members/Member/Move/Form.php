<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Members\Member\Move;

use App\Model\Work\Entity\Members\Group\GroupRepository;
use App\ReadModel\Work\Members\GroupFetcher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{
    /**
     * @var GroupFetcher
     */
    private $groups;

    /**
     * @param GroupFetcher $groups
     */
    public function __construct(GroupFetcher $groups)
    {
        $this->groups = $groups;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('group', ChoiceType::class, ['choices' => array_flip($this->groups->assoc())]);
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


}