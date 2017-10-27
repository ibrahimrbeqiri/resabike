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
