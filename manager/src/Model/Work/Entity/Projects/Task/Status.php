<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Task;

use Webmozart\Assert\Assert;

class Status
{
    public const NEW = 'new';
    public const WORKING = 'working';
    public const HELP = 'help';
    public const CHECKING = 'checking';
    public const REJECTED = 'rejected';
    public const DONE = 'done';

    private $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        Assert::oneOf($name, [
            self::NEW,
            self::WORKING,
            self::HELP,
            self::CHECKING,
            self::REJECTED,
            self::DONE
        ]);
        $this->name = $name;
    }

    /**
     * @return static
     */
    public static function new(): self
    {
        return new self(self::NEW);
    }

    /**
     * @return static
     */
    public static function working(): self
    {
        return new self(self::WORKING);
    }

    /**
     * @param Status $other
     * @return bool
     */
    public function isEqual(self $other): bool
    {
        return $this->getName() === $other->getName();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->name === self::DONE;
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->name === self::NEW;
    }

    /**
     * @return bool
     */
    public function isWorking(): bool
    {
        return $this->name === self::WORKING;
    }
}