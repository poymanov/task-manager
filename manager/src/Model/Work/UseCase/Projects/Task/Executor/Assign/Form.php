<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Executor\Assign;

use App\ReadModel\Work\Members\Members\Member\MemberFetcher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{
    /**
     * @var MemberFetcher
     */
    private $members;

    /**
     * @param MemberFetcher $members
     */
    public function __construct(MemberFetcher $members)
    {
        $this->members = $members;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $members = [];

        foreach ($this->members->activeDepartmentListForProject($options['project_id']) as $item) {
            $members[$item['department'] . ' - ' . $item['name']] = $item['id'];
        }

        $builder
            ->add('members', ChoiceType::class, [
                'choices' => $members,
                'expanded' => true,
                'multiple' => true
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Command::class,
        ]);
        $resolver->setRequired(['project_id']);
    }
}