<?php
declare(strict_types=1);

namespace App\ReadModel\User;

class AuthView
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password_hash;

    /**
     * @var string
     */
    public $role;
}