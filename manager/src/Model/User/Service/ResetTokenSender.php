<?php

declare(strict_types=1);

namespace App\Model\User\Service;

use App\Model\User\Entity\User\Email as UserEmail;
use App\Model\User\Entity\User\ResetToken;
use RuntimeException;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ResetTokenSender
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var Environment;
     */
    private $twig;

    /**
     * @var array
     */
    private $from;

    /**
     * @param MailerInterface $mailer
     * @param Environment $twig
     * @param array $from
     */
    public function __construct(MailerInterface $mailer, Environment $twig, array $from)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->from = $from;
    }

    /**
     * @param UserEmail $email
     * @param ResetToken $token
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws TransportExceptionInterface
     */
    public function send(UserEmail $email, ResetToken $token): void
    {
        $subject = 'Password resetting';
        $email = (new Email())
            ->subject($subject)
            ->to($email->getValue())
            ->from(new Address($this->from['email'], $this->from['name']))
            ->html($this->twig->render('mail/user/reset.html.twig', ['token' => $token->getToken()]));

        try {
            $this->mailer->send($email);
        } catch (TransportException $e) {
            throw new RuntimeException('Unable to send message.');
        }
    }
}