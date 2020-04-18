<?php

declare(strict_types=1);

namespace App\Widget\Work\Projects;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ActionRowWidget extends AbstractExtension
{
    /**
     * @return array|TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('work_projects_action_row', [$this, 'row'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    /**
     * @param Environment $twig
     * @param array $action
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function row(Environment $twig, array $action): string
    {
        return $twig->render('widget/work/projects/action-row.html.twig', compact('action'));
    }
}