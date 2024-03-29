<?php

declare(strict_types=1);

namespace App\Service;

class Gravatar
{
    /**
     * @param string $email
     * @param int $size
     * @return string
     */
    public static function url(string $email, int $size): string
    {
        return '//www.gravatar.com/avatar/' . md5($email) . '?' . http_build_query(['s' => $size, 'd' => 'identicon']);
    }
}