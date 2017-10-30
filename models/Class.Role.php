<?php

class Role
{

    private $roleId;
    private $role;


    public function __construct($roleId=null, $role)
    {
        $this->setroleId($roleId);
        $this->setRole($role);
    }

    public function getroleId()
    {
        return $this->roleId;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setroleId($roleId)
    {
        $this->roleId = $roleId;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

	public static function getRoles(){
	    
		$query = "SELECT * FROM role";

		$result = MySQLConnection::getInstance()->fetch($query);
		if($result['status']=='error' || empty($result['result'])){
		  return $result;
		}

	   $roles = $result['result'];

		return $roles;
	}
}
