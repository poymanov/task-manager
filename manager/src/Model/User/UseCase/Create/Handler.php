<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Create;

use App\Model\Flusher;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\Name;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\UserRepository;
use App\Model\User\Service\PasswordGenerator;
use App\Model\User\Service\PasswordHasher;
use DateTimeImmutable;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use DomainException;
use Exception;

class Handler
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var PasswordHasher
     */
    private $hasher;

    /**
     * @var PasswordGenerator
     */
    private $generate;

    /**
     * @var Flusher
     */
    private $flusher;

    /**
     * @param UserRepository $users
     * @param PasswordHasher $hasher
     * @param PasswordGenerator $generate
     * @param Flusher $flusher
     */
    public function __construct(UserRepository $users, PasswordHasher $hasher, PasswordGenerator $generate, Flusher $flusher)
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->generate = $generate;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        if ($this->users->hasByMail($email)) {
            throw new DomainException('User with this email already exists.');
        }

        $user = User::create(
            Id::next(),
            new DateTimeImmutable(),
            new Name($command->firstName, $command->lastName),
            $email,
            $this->hasher->hash($this->generate->generate())
        );

        $this->users->add($user);

        $this->flusher->flush();
    }
}