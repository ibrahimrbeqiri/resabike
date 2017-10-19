<?php

class Role
{
    
    private $id;
    private $role;
    
    
    public function __construct($id=null, $role) 
    {
        $this->setId($id);
        $this->setRole($role);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
}

