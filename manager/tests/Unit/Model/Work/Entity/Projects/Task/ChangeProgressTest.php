<?php

declare(strict_types=1);

namespace App\Tests\Unit\Model\Work\Entity\Projects\Task;

use App\Tests\Builder\Work\Members\GroupBuilder;
use App\Tests\Builder\Work\Members\MemberBuilder;
use App\Tests\Builder\Work\Projects\ProjectBuilder;
use App\Tests\Builder\Work\Projects\TaskBuilder;
use DateTimeImmutable;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ChangeProgressTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess()
    {
        $group = (new GroupBuilder())->build();
        $member = (new MemberBuilder())->build($group);
        $project = (new ProjectBuilder())->build();
        $task = (new TaskBuilder())->build($project, $member);

        $task->changeProgress($member, new DateTimeImmutable(), $progress = 25);

        self::assertEquals($progress, $task->getProgress());
    }

    /**
     * @throws Exception
     */
    public function testAlready(): void
    {
        $group = (new GroupBuilder())->build();
        $member = (new MemberBuilder())->build($group);
        $project = (new ProjectBuilder())->build();
        $task = (new TaskBuilder())->build($project, $member);

        $task->changeProgress($member, new DateTimeImmutable(), $progress = 25);

        $this->expectExceptionMessage('Progress is already same.');
        $task->changeProgress($member, new DateTimeImmutable(), $progress);
    }

    /**
     * @throws Exception
     */
    public function testIncorrect(): void
    {
        $group = (new GroupBuilder())->build();
        $member = (new MemberBuilder())->build($group);
        $project = (new ProjectBuilder())->build();
        $task = (new TaskBuilder())->build($project, $member);

        $this->expectException(InvalidArgumentException::class);
        $task->changeProgress($member, new DateTimeImmutable(), 200);
    }
}