<?php

declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Project\Membership\Add;

use App\ReadModel\Work\Members\Members\Member\MemberFetcher;
use App\ReadModel\Work\Projects\Project\DepartmentFetcher;
use App\ReadModel\Work\Projects\RoleFetcher;
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
     * @var RoleFetcher
     */
    private $roles;

    /**
     * @var DepartmentFetcher
     */
    private $departments;

    /**
     * @param MemberFetcher $members
     * @param RoleFetcher $roles
     * @param DepartmentFetcher $departments
     */
    public function __construct(MemberFetcher $members, RoleFetcher $roles, DepartmentFetcher $departments)
    {
        $this->members = $members;
        $this->roles = $roles;
        $this->departments = $departments;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $members = [];

        foreach ($this->members->activeGroupedList() as $item) {
            $members[$item['group']][$item['name']] = $item['id'];
        }

        $builder
            ->add('member', ChoiceType::class, [
                'choices' => $members
            ])
            ->add('departments', ChoiceType::class, [
                'choice' => array_flip($this->departments->listOfProject($options['project'])),
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('roles', ChoiceType::class, [
                'choice' => array_flip($this->roles->allList()),
                'expanded' => true,
                'multiple' => true,
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Command::class
        ]);
        $resolver->setRequired(['project']);
    }
}