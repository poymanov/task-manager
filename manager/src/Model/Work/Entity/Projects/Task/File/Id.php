<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Task\File;

use Exception;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class Id
{
    /**
     * @var string
     */
    private $value;

    /**
     * Id constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

    /**
     * @return static
     * @throws Exception
     */
    public static function next(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    /**
     * @param Id $other
     * @return bool
     */
    public function isEqual(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    /**
     * @return string
     */
    public function getValue(): string
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