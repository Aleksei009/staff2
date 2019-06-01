<?php

 namespace Staff\Roles;

use Phalcon\Acl\RoleAware;

class UserRole implements RoleAware
{

    protected $id;

    protected $roleName;

    public function __construct($id, $roleName)
    {
        $this->id       = $id;
        $this->roleName = $roleName;
    }

    public function getId()
    {
        return $this->id;
    }

    // Implemented function from RoleAware Interface
    public function getRoleName()
    {
        return $this->roleName;
    }

}