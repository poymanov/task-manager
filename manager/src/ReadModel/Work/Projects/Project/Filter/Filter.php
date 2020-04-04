<?php

declare(strict_types=1);

namespace App\ReadModel\Work\Projects\Project\Filter;

use App\Model\Work\Entity\Members\Member\Status;

class Filter
{
    /**
     * @var string|null
     */
    public $member;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $status = Status::ACTIVE;

    /**
     * @param string|null $member
     */
    public function __construct(?string $member)
    {
        $this->member = $member;
    }

    /**
     * @return static
     */
    public static function all(): self
    {
        return new self(null);
    }

    /**
     * @param string $id
     * @return static
     */
    public static function forMember(string $id): self
    {
        return new self($id);
    }

}