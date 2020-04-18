<?php

declare(strict_types=1);

namespace App\ReadModel\Comment;

class CommentRow
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
    public $author_id;

    /**
     * @var string
     */
    public $author_name;

    /**
     * @var string
     */
    public $author_email;

    /**
     * @var string
     */
    public $text;
}