<?php

declare(strict_types=1);

namespace App\Tests\Functional\Api\Work\Projects;

use App\Model\User\Entity\User\Email as UserEmail;
use App\Model\User\Entity\User\Role;
use App\Model\User\Entity\User\User;
use App\Model\User\Service\PasswordHasher;
use App\Model\Work\Entity\Members\Member\Email as MemberEmail;
use App\Model\Work\Entity\Members\Member\Id as MemberId;
use App\Model\Work\Entity\Projects\Project\Department\Id as DepartmentId;
use App\Model\Work\Entity\Projects\Project\Id;
use App\Model\Work\Entity\Projects\Project\Project;
use App\Model\Work\Entity\Projects\Role\Permission;
use App\Tests\Builder\User\UserBuilder;
use App\Tests\Builder\Work\Members\GroupBuilder;
use App\Tests\Builder\Work\Members\MemberBuilder;
use App\Tests\Builder\Work\Members\RoleBuilder;
use App\Tests\Functional\AuthFixture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class IndexFixture extends Fixture implements DependentFixtureInterface
{
    public const ID_1 = '00000000-0000-0000-0000-000000000001';
    public const ID_2 = '00000000-0000-0000-0000-000000000002';
    public const ID_3 = '00000000-0000-0000-0000-000000000003';
    public const ID_4 = '00000000-0000-0000-0000-000000000004';

    /**
     * @var PasswordHasher
     */
    private $hasher;

    /**
     * @param PasswordHasher $hasher
     */
    public function __construct(PasswordHasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @return array|string[]
     */
    public static function userCredentials(): array
    {
        return [
            'PHP_AUTH_USER' => 'user-projects-index@app.test',
            'PHP_AUTH_PW' => 'password',
        ];
    }

    /**
     * @return array|string[]
     */
    public static function adminCredentials(): array
    {
        return [
            'PHP_AUTH_USER' => 'admin-projects-index@app.test',
            'PHP_AUTH_PW' => 'password',
        ];
    }

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $hash = $this->hasher->hash('password');

        $user = (new UserBuilder())
            ->viaEmail(new UserEmail('user-projects-index@app.test'), $hash)
            ->confirmed()
            ->build();

        $manager->persist($user);

        $admin = (new UserBuilder())
            ->viaEmail(new UserEmail('admin-projects-index@app.test'), $hash)
            ->confirmed()
            ->withRole(Role::admin())
            ->build();

        $manager->persist($admin);

        $group = (new GroupBuilder())
            ->withName('Test Staff')
            ->build();

        $manager->persist($group);

        $userMember = (new MemberBuilder())
            ->withId(new MemberId($user->getId()->getValue()))
            ->withEmail(new MemberEmail($user->getEmail()->getValue()))
            ->build($group);

        $manager->persist($userMember);

        $developerRole = (new RoleBuilder())
            ->withName('Index Developer')
            ->withPermissions([Permission::MANAGE_TASKS])
            ->build();

        $manager->persist($developerRole);

        $project = new Project(new Id(self::ID_1), 'Project Test Index First', 1);
        $manager->persist($project);

        $project = new Project(new Id(self::ID_2), 'Project Test Index Second', 2);
        $project->addDepartment($departmentId = DepartmentId::next(), 'Development');
        $project->addMember($userMember, [$departmentId], [$developerRole]);
        $project->archive();
        $manager->persist($project);

        $project = new Project(new Id(self::ID_3), 'Project Test Index Third', 4);
        $manager->persist($project);

        $project = new Project(new Id(self::ID_4), 'Project Test Index Fourth', 3);
        $project->addDepartment($departmentId = DepartmentId::next(), 'Development');
        $project->addMember($userMember, [$departmentId], [$developerRole]);
        $manager->persist($project);

        $manager->flush();
    }

    /**
     * @return array|string[]
     */
    public function getDependencies(): array
    {
        return [
            AuthFixture::class
        ];
    }

    /**
     * @param string $reference
     * @return User
     */
    private function getUser(string $reference): User
    {
        return $this->getReference($reference);
    }
}