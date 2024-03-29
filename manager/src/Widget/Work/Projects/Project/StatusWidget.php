<?php

declare(strict_types=1);

namespace App\Widget\Work\Projects\Project;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class StatusWidget extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('project_status', [$this, 'status'], ['needs_environment' => true, 'is_safe' => ['html']])
        ];
    }

    /**
     * @param Environment $twig
     * @param string $status
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function status(Environment $twig, string $status): string
    {
        return $twig->render('widget/work/projects/project/status.html.twig', [
            'status' => $status
        ]);
    }
}