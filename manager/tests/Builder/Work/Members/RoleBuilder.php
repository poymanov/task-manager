<?php

declare(strict_types=1);

namespace App\Tests\Builder\Work\Members;

use App\Model\Work\Entity\Projects\Role\Id;
use App\Model\Work\Entity\Projects\Role\Role;


class RoleBuilder
{
    /**
     * @var Id
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $permissions;

    public function __construct()
    {
        $this->id = Id::next();
        $this->name = 'Role';
        $this->permissions = [];
    }

    /**
     * @param string $name
     * @return $this
     */
    public function withName(string $name): self
    {
        $clone = clone $this;
        $clone->name = $name;

        return $clone;
    }

    /**
     * @param array $permissions
     * @return $this
     */
    public function withPermissions(array $permissions): self
    {
        $clone = clone $this;
        $clone->permissions = $permissions;

        return $clone;
    }

    /**
     * @return Role
     */
    public function build(): Role
    {
        return new Role($this->id, $this->name, $this->permissions);
    }
}