<?php

declare(strict_types=1);

namespace App\Widget\Work\Projects\Project;

use App\ReadModel\Work\Projects\Calendar\CalendarFetcher;
use App\Security\UserIdentity;
use DateInterval;
use DatePeriod;
use DateTimeImmutable;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CalendarWidget extends AbstractExtension
{
    /**
     * @var CalendarFetcher
     */
    private $calendar;

    /**
     * @var TokenStorageInterface
     */
    private $tokens;

    /**
     * @param CalendarFetcher $calendar
     * @param TokenStorageInterface $tokens
     */
    public function __construct(CalendarFetcher $calendar, TokenStorageInterface $tokens)
    {
        $this->calendar = $calendar;
        $this->tokens = $tokens;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('work_projects_calendar', [$this, 'calendar'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    /**
     * @param Environment $twig
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function calendar(Environment $twig): string
    {
        if (null === $token = $this->tokens->getToken()) {
            return '';
        }

        if (!($user = $token->getUser()) instanceof UserIdentity) {
            return '';
        }

        $now = new DateTimeImmutable();
        $result = $this->calendar->byWeek($now, $user->getId());

        return $twig->render('widget/work/projects/calendar.html.twig', [
            'dates' => iterator_to_array(new DatePeriod($result->start, new DateInterval('P1D'), $result->end)),
            'now' => $now,
            'result' => $result,
        ]);
    }
}