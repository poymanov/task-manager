<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Task\Change;

use Exception;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class Id
{
    /**
     * @var int
     */
    private $value;

    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

    public static function first(): self
    {
        return new self(1);
    }

    /**
     * @return static
     * @throws Exception
     */
    public function next(): self
    {
        return new self($this->value + 1);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getValue();
    }
}