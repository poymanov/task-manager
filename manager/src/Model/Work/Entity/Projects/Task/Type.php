<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Task;

use Webmozart\Assert\Assert;

class Type
{
    public const NONE = 'none';
    public const ERROR = 'error';
    public const FEATURE = 'feature';

    /**
     * @var string
     */
    private $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        Assert::oneOf($name, [
            self::NONE,
            self::ERROR,
            self::FEATURE
        ]);
        
        $this->name = $name;
    }

    /**
     * @param Type $other
     * @return bool
     */
    public function isEqual(self $other): bool
    {
        return $this->getName() === $other->getName();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}