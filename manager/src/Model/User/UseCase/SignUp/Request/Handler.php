<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Request;

use App\Model\Flusher;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\UserRepository;
use App\Model\User\Service\SignUpConfirmTokenizer;
use App\Model\User\Service\SignUpConfirmTokenSender;
use App\Model\User\Service\PasswordHasher;
use DateTimeImmutable;
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
     * @var SignUpConfirmTokenizer
     */
    private $tokenizer;

    /**
     * @var SignUpConfirmTokenSender
     */
    private $sender;

    /**
     * @var Flusher
     */
    private $flusher;

    /**
     * Handler constructor.
     * @param UserRepository $users
     * @param PasswordHasher $hasher
     * @param SignUpConfirmTokenizer $tokenizer
     * @param SignUpConfirmTokenSender $sender
     * @param Flusher $flusher
     */
    public function __construct(UserRepository $users, PasswordHasher $hasher, SignUpConfirmTokenizer $tokenizer, SignUpConfirmTokenSender $sender, Flusher $flusher)
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        if ($this->users->hasByMail($email)) {
            throw new DomainException('User already exists.');
        }

        $user = User::signUpByEmail(Id::next(), new DateTimeImmutable(), $email, $this->hasher->hash($command->password),
            $token = $this->tokenizer->generate());

        $this->users->add($user);
        $this->sender->send($email, $token);
        $this->flusher->flush();
    }
}