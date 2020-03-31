<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Edit;

use App\Model\User\Entity\User\User;
use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $id;

    /**
     * @Assert\Email()
     * @Assert\NotBlank()
     * @var string
     */
    public $email;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $firstName;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $lastName;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param User $user
     * @return static
     */
    public static function fromUser(User $user): self
    {
        $command = new self($user->getId()->getValue());
        $command->email = $user->getEmail() ? $user->getEmail()->getValue() : null;
        $command->firstName = $user->getName()->getFirst();
        $command->lastName = $user->getName()->getLast();

        return $command;
    }
}