<?php

declare(strict_types=1);

namespace App\Security\Voter\Work\Projects;

use App\Model\Work\Entity\Members\Member\Id;
use App\Model\Work\Entity\Projects\Role\Permission;
use App\Model\Work\Entity\Projects\Task\Task;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TaskAccess extends Voter
{
    public const VIEW = 'view';
    public const MANAGE = 'edit';
    public const DELETE = 'delete';

    /**
     * @var AuthorizationCheckerInterface
     */
    private $security;

    /**
     * @param AuthorizationCheckerInterface $security
     */
    public function __construct(AuthorizationCheckerInterface $security)
    {
        $this->security = $security;
    }

    /**
     * @inheritDoc
     */
    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, [self::VIEW, self::MANAGE, self::DELETE]) && $subject instanceof Task;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::VIEW:
                return
                    $this->security->isGranted('ROLE_WORK_MANAGE_PROJECTS') ||
                    $subject->getProject()->isMemberGranted(new Id($user->getId()), Permission::VIEW_TASKS);
            case self::MANAGE:
                return
                    $this->security->isGranted('ROLE_WORK_MANAGE_PROJECTS') ||
                    $subject->getProject()->isMemberGranted(new Id($user->getId()), Permission::MANAGE_TASKS);
            case self::DELETE:
                return
                    $this->security->isGranted('ROLE_WORK_MANAGE_PROJECTS');
                break;
        }

        return false;
    }
}