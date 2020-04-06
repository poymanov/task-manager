<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Task;

use Exception;
use Keiko\Uuid\Shortener\Dictionary;
use Keiko\Uuid\Shortener\Number\BigInt\Converter;
use Keiko\Uuid\Shortener\Shortener;
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
        $shortener = new Shortener(Dictionary::createUnmistakable(), new Converter());
        $uuid = Uuid::uuid4()->toString();

        return new self($shortener->reduce($uuid));
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