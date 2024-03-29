<?php

declare(strict_types=1);

namespace App\DataFixtures\Work\Projects;

use App\DataFixtures\Work\Members\MemberFixture;
use App\Model\User\Entity\User\Role;
use App\Model\Work\Entity\Members\Member\Member;
use App\Model\Work\Entity\Projects\Project\Department\Id as DepartmentId;
use App\Model\Work\Entity\Projects\Project\Id;
use App\Model\Work\Entity\Projects\Project\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class ProjectFixture extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE_FIRST = 'first';
    public const REFERENCE_SECOND = 'second';

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var Member $admin
         * @var Member $user
         */
        $admin = $this->getReference(MemberFixture::REFERENCE_ADMIN);
        $user = $this->getReference(MemberFixture::REFERENCE_USER);

        /**
         * @var Role $manager
         * @var Role $guest
         */
        $manage = $this->getReference(RoleFixture::REFERENCE_MANAGER);
        $guest = $this->getReference(RoleFixture::REFERENCE_GUEST);

        $active = $this->createProject('First Project', 1);
        $active->addDepartment($development = DepartmentId::next(), 'Development');
        $active->addDepartment($marketing = DepartmentId::next(), 'Marketing');

        $active->addMember($admin, [$development], [$manage]);
        $active->addMember($user, [$marketing], [$guest]);

        $manager->persist($active);
        $this->setReference(self::REFERENCE_FIRST, $active);

        $active = $this->createProject('Second Project', 2);

        $active->addDepartment($development = DepartmentId::next(), 'Development');
        $active->addMember($admin, [$development], [$guest]);

        $manager->persist($active);
        $this->setReference(self::REFERENCE_SECOND, $active);

        $archived = $this->createArchivedProject('Third Project', 3);
        $manager->persist($archived);

        $manager->flush();
    }

    /**
     * @param string $name
     * @param int $sort
     * @return Project
     * @throws Exception
     */
    private function createArchivedProject(string $name, int $sort): Project
    {
        $project = $this->createProject($name, $sort);
        $project->archive();
        return $project;
    }

    /**
     * @param string $name
     * @param int $sort
     * @return Project
     * @throws Exception
     */
    private function createProject(string $name, int $sort): Project
    {
        return new Project(
            Id::next(),
            $name,
            $sort
        );
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            MemberFixture::class,
            RoleFixture::class,
        ];
    }
}