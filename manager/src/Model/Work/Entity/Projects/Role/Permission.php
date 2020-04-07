<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Role;

use Webmozart\Assert\Assert;

class Permission
{
    public const MANAGE_PROJECT_MEMBERS = 'manage_project_members';
    public const VIEW_TASKS = 'view_tasks';
    public const MANAGE_TASKS = 'manage_tasks';

    private $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        Assert::oneOf($name, self::names());
        $this->name = $name;
    }

    /**
     * @return array
     */
    public static function names(): array
    {
        return [
            self::MANAGE_PROJECT_MEMBERS,
            self::VIEW_TASKS,
            self::MANAGE_TASKS,
        ];
    }

    public function isNameEqual(string $name): bool
    {
        return $this->name == $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}