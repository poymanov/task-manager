<?php

declare(strict_types=1);

namespace App\ReadModel\Work\Projects\Task\Filter;

use App\Model\Work\Entity\Projects\Task\Status;
use App\Model\Work\Entity\Projects\Task\Type;
use App\ReadModel\Work\Members\Members\Member\MemberFetcher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $executors = [];

        foreach ($this->members->activeGroupedList() as $item) {
            $executors[$item['group']][$item['name']] = $item['id'];
        }

        $builder
            ->add('name', TextType::class, ['required' => false, 'attr' => [
                'placeholder' => 'Search...',
                'onchange' => 'this.form.submit()'
            ]])
            ->add('type', ChoiceType::class, ['choices' => [
                'None' => Type::NONE,
                'Error' => Type::ERROR,
                'Feature' => Type::FEATURE,
            ], 'required' => false, 'placeholder' => 'All types', 'attr' => ['onchange' => 'this.form.submit()']])
            ->add('status', ChoiceType::class, ['choices' => [
                'New' => Status::NEW,
                'Working' => Status::WORKING,
                'Need Help' => Status::HELP,
                'Checking' => Status::CHECKING,
                'Rejected' => Status::REJECTED,
                'Done' => Status::DONE,
            ], 'required' => false, 'placeholder' => 'All statuses', 'attr' => ['onchange' => 'this.form.submit()']])
            ->add('priority', ChoiceType::class, ['choices' => [
                'Low' => 1,
                'Normal' => 2,
                'High' => 3,
                'Extra' => 4
            ], 'required' => false, 'placeholder' => 'All priorities', 'attr' => ['onchange' => 'this.form.submit()']])
            ->add('executor', ChoiceType::class, [
                'choices' => $executors,
                'required' => false,
                'placeholder' => 'All executors',
                'attr' => ['onchange' => 'this.form.submit()']
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filter::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }


}