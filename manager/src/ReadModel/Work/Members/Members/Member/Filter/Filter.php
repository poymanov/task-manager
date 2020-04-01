<?php

declare(strict_types=1);

namespace App\ReadModel\Work\Members\Members\Member\Filter;

use App\Model\Work\Entity\Members\Member\Status;

class Filter
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $group;

    /**
     * @var string
     */
    public $status = Status::ACTIVE;
}