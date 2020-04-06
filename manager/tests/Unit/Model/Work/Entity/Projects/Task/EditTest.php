<?php

declare(strict_types=1);

namespace App\Tests\Unit\Model\Work\Entity\Projects\Task;

use App\Tests\Builder\Work\Members\GroupBuilder;
use App\Tests\Builder\Work\Members\MemberBuilder;
use App\Tests\Builder\Work\Projects\ProjectBuilder;
use App\Tests\Builder\Work\Projects\TaskBuilder;
use Exception;
use PHPUnit\Framework\TestCase;

class EditTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess(): void
    {
        $group = (new GroupBuilder())->build();
        $member = (new MemberBuilder())->build($group);
        $project = (new ProjectBuilder())->build();

        $task = (new TaskBuilder())->build($project, $member);

        $task->edit(
            $name = 'New Name',
            $content = 'New Content'
        );

        self::assertEquals($name, $task->getName());
        self::assertEquals($content, $task->getContent());
    }
}