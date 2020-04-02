<?php

declare(strict_types=1);

namespace App\Controller\Profile\OAuth;

use App\Model\User\UseCase\Network\Attach\Command;
use App\Model\User\UseCase\Network\Attach\Handler;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use DomainException;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FacebookController extends AbstractController
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * FacebookController constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/attach", name="profile.oauth.facebook")
     * @param ClientRegistry $clientRegistry
     * @return Response
     */
    public function connect(ClientRegistry $clientRegistry): Response
    {
        return $clientRegistry
            ->getClient('facebook_attach')
            ->redirect(['public_profile'], []);
    }

    /**
     * @Route("/check", name="profile.oauth.facebook_check")
     * @param ClientRegistry $clientRegistry
     * @param Handler $handler
     * @return Response
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function check(ClientRegistry $clientRegistry, Handler $handler): Response
    {
        $client = $clientRegistry->getClient('facebook_attach');

        $command = new Command(
            $this->getUser()->getId(),
            'facebook',
            $client->fetchUser()->getId()
        );

        try {
            $handler->handle($command);
            $this->addFlash('success', 'Facebook is successfully attached.');
            return $this->redirectToRoute('profile');
        } catch (DomainException $e) {
            $this->logger->warning($e->getMessage(), ['exception' => $e]);
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('profile');
        }
    }
}