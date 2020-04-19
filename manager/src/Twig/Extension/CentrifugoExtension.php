<?php

declare(strict_types=1);

namespace App\Twig\Extension;

use App\Security\UserIdentity;
use phpcent\Client;
use Symfony\Component\Security\Core\Security;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CentrifugoExtension extends AbstractExtension
{
    /**
     * @var Client
     */
    public $centrifugo;

    /**
     * @var Security
     */
    private $security;

    /**
     * @param Client $centrifugo
     * @param Security $security
     */
    public function __construct(Client $centrifugo, Security $security)
    {
        $this->centrifugo = $centrifugo;
        $this->security = $security;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('centrifugo_token', [$this, 'token', ['is_safe' => ['html']]])
        ];
    }

    /**
     * @return string
     */
    public function token(): string
    {
        if (!$user = $this->security->getUser()) {
            return '';
        }

        if (!$user instanceof UserIdentity) {
            return '';
        }

        return $this->centrifugo->generateConnectionToken($user->getId(), time() + 3600 * 12);
    }
}