<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_user_networks", uniqueConstraints={
 *      @ORM\UniqueConstraint(columns={"network", "identity"})
 * })
 */
class Network
{
    /**
     * @var string
     * @ORM\Column(type="guid")
     * @ORM\Id
     */
    public $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="networks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $network;

    /**
     * @var string
     * @ORM\Column(type="string", length=32, nullable=true)
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

    /**
     * @param string $network
     * @param string $identity
     * @return bool
     */
    public function isFor(string $network, string $identity): bool
    {
        return $this->network == $network && $this->identity == $identity;
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