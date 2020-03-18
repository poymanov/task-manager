<?php

declare(strict_types=1);

namespace App\Tests\Builder\User;

use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\User;
use BadMethodCallException;
use DateTimeImmutable;
use Exception;

class UserBuilder
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $confirmed;

    /**
     * @var string
     */
    private $network;

    /**
     * @var string
     */
    private $identity;

    /**
     * UserBuilder constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = Id::next();
        $this->date = new DateTimeImmutable();
    }

    /**
     * @param Email|null $email
     * @param string|null $hash
     * @param string|null $token
     * @return $this
     */
    public function viaEmail(Email $email = null, string $hash = null, string $token = null): self
    {
        $clone = clone $this;
        $clone->email = $email ?? new Email('mail@app.test');
        $clone->hash = $hash ?? 'hash';
        $clone->token = $token ?? 'token';

        return $clone;
    }

    /**
     * @param string|null $network
     * @param string|null $identity
     * @return $this
     */
    public function viaNetwork(string $network = null, string $identity = null): self
    {
        $clone = clone $this;
        $clone->network = $network ?? 'vk';
        $clone->identity = $identity ?? '0001';

        return $clone;
    }

    /**
     * @return $this
     */
    public function confirmed(): self
    {
        $clone = clone $this;
        $clone->confirmed = true;
        return $clone;
    }

    /**
     * @return User
     * @throws Exception
     */
    public function build(): User
    {
        if ($this->email) {
            $user = User::signUpByEmail($this->id, $this->date, $this->email, $this->hash, $this->token);

            if ($this->confirmed) {
                $user->confirmSignUp();
            }

            return $user;
        }

        if ($this->network) {
            return User::signUpByNetwork($this->id, $this->date, $this->network, $this->identity);
        }

        throw new BadMethodCallException('Specify via method.');
    }
}