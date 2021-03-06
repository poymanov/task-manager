<?php

declare(strict_types=1);

namespace App\Model\Comment\Entity\Comment;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment_comments", indexes={
 *      @ORM\Index(columns={"date"}),
 *      @ORM\Index(columns={"entity_type", "entity_id"})
 * })
 */
class Comment
{
    /**
     * @var Id
     * @ORM\Column(type="comment_comment_id")
     * @ORM\Id
     */
    private $id;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    /**
     * @var AuthorId
     * @ORM\Column(type="comment_comment_author_id")
     */
    private $authorId;

    /**
     * @var Entity
     * @ORM\Embedded(class="Entity")
     */
    private $entity;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", nullable=true, name="update_date")
     */
    private $updateDate;

    /**
     * @var int
     * @ORM\Version()
     * @ORM\Column(type="integer")
     */
    private $version;

    /**
     * @param Id $id
     * @param DateTimeImmutable $date
     * @param AuthorId $authorId
     * @param Entity $entity
     * @param string $text
     */
    public function __construct(AuthorId $authorId, Id $id, DateTimeImmutable $date, string $text, Entity $entity)
    {
        $this->id = $id;
        $this->date = $date;
        $this->authorId = $authorId;
        $this->entity = $entity;
        $this->text = $text;
    }

    /**
     * @param DateTimeImmutable $date
     * @param string $text
     */
    public function edit(DateTimeImmutable $date, string $text): void
    {
        $this->updateDate = $date;
        $this->text = $text;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return AuthorId
     */
    public function getAuthorId(): AuthorId
    {
        return $this->authorId;
    }

    /**
     * @return Entity
     */
    public function getEntity(): Entity
    {
        return $this->entity;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}