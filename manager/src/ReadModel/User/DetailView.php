<?php

declare(strict_types=1);

namespace App\ReadModel\User;

class DetailView
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $date;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $role;

    /**
     * @var string
     */
    public $status;


    /**
     * @var NetworkView[]
     */
    public $networks;
}