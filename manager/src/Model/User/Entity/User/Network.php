<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use Exception;
use Ramsey\Uuid\Uuid;

class Network
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $network;

    /**
     * @var string
     */
    private $identity;

    /**
     * Network constructor.
     * @param User $user
     * @param string $network
     * @param string $identity
     * @throws Exception
     */
    public function __construct(User $user, string $network, string $identity)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->user = $user;
        $this->network = $network;
        $this->identity = $identity;
    }

    public function isForNetwork(string $network): bool
    {
        return $this->network === $network;
    }

    /**
     * @return string
     */
    public function getNetwork(): string
    {
        return $this->network;
    }

    /**
     * @return string
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }
}