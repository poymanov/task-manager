<?php

declare(strict_types=1);

namespace App\Tests\Builder\Work\Members;

use App\Model\Work\Entity\Members\Group\Group;
use App\Model\Work\Entity\Members\Member\Email;
use App\Model\Work\Entity\Members\Member\Id;
use App\Model\Work\Entity\Members\Member\Member;
use App\Model\Work\Entity\Members\Member\Name;
use Exception;

class MemberBuilder
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var Email
     */
    private $email;

    public function __construct()
    {
        $this->id = Id::next();
        $this->name = new Name('First', 'Last');
        $this->email = new Email('member@app.test');
    }

    /**
     * @param Id $id
     * @return $this
     */
    public function withId(Id $id): self
    {
        $clone = clone $this;
        $clone->id = $id;
        return $clone;
    }

    /**
     * @param Email $email
     * @return $this
     */
    public function withEmail(Email $email): self
    {
        $clone = clone $this;
        $clone->email = $email;
        return $clone;
    }

    /**
     * @param Group $group
     * @return Member
     * @throws Exception
     */
    public function build(Group $group): Member
    {
        return new Member(
            $this->id,
            $group,
            $this->name,
            $this->email
        );
    }
}