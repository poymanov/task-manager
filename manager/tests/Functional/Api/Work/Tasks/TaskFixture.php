<?php

declare(strict_types=1);

namespace App\Tests\Functional\Api\Work\Tasks;

use App\Model\Work\Entity\Members\Member\Member;
use App\Model\Work\Entity\Projects\Project\Department\Id as DepartmentId;
use App\Model\Work\Entity\Projects\Role\Permission;
use App\Model\Work\Entity\Projects\Task\Id as TaskId;
use App\Tests\Builder\Work\Members\RoleBuilder;
use App\Tests\Builder\Work\Projects\ProjectBuilder;
use App\Tests\Builder\Work\Projects\TaskBuilder;
use App\Tests\Functional\Api\Work\MemberFixture;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TaskFixture extends Fixture implements DependentFixtureInterface
{
    public const TASK_IN_PROJECT_WITH_USER = '00000000-0000-0000-0000-000000000001';
    public const TASK_IN_PROJECT_WITHOUT_USER = '00000000-0000-0000-0000-000000000002';
    public const TASK_IN_PROJECT_WITH_USER_WITH_PLAN = '00000000-0000-0000-0000-000000000003';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        /**
         * @var Member $adminMember
         * @var Member $userMember
         */
        $adminMember = $this->getReference(MemberFixture::REFERENCE_MEMBER_ADMIN);
        $userMember = $this->getReference(MemberFixture::REFERENCE_MEMBER_USER);

        $developerRole = (new RoleBuilder())
            ->withPermissions([Permission::VIEW_TASKS, Permission::MANAGE_TASKS])
            ->build();

        $manager->persist($developerRole);

        $project = (new ProjectBuilder())->withName('Project With User')->build();
        $project->addDepartment($departmentId = DepartmentId::next(), 'Development');
        $project->addMember($userMember, [$departmentId], [$developerRole]);
        $manager->persist($project);

        $task = (new TaskBuilder())
            ->withId(new TaskId(self::TASK_IN_PROJECT_WITH_USER))
            ->build($project, $userMember);
        $manager->persist($task);

        $task = (new TaskBuilder())
            ->withId(new TaskId(self::TASK_IN_PROJECT_WITH_USER_WITH_PLAN))
            ->build($project, $userMember);
        $task->plan($userMember, new DateTimeImmutable(), new DateTimeImmutable('+1 day'));
        $manager->persist($task);

        $project = (new ProjectBuilder())->withName('Project Without User')->build();
        $manager->persist($project);

        $task = (new TaskBuilder())
            ->withId(new TaskId(self::TASK_IN_PROJECT_WITHOUT_USER))
            ->build($project, $adminMember);
        $manager->persist($task);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            MemberFixture::class
        ];
    }
}