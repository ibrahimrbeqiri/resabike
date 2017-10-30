<?php
require_once 'dal/MySQLConnection.php';
class User{
	private $id;
	private $name;
	private $lastname;
	private $username;
	private $email;
	private $password;
    private $phone;
    private $roleId;
    private $userRegionId;
    
	public function __construct($id=null, $name, $lastname, $username, $email, $password, $phone, $roleId, $userRegionId){
		$this->setId($id);
		$this->setName($name);
		$this->setLastname($lastname);
		$this->setUsername($username);
		$this->setEmail($email);
		$this->setPassword($password);
		$this->setPhone($phone);
		$this->setRoleId($roleId);
		$this->setuserRegionId($userRegionId);
	}

	public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }

    public function getuserRegionId()
    {
        return $this->userRegionId;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    }

    public function setuserRegionId($userRegionId)
    {
        $this->userRegionId = $userRegionId;
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getLastname(){
		return $this->lastname;
	}

	public function setLastname($lastname){
		$this->lastname = $lastname;
	}

	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function save(){
		$pwd = sha1($this->password);
		$query = "INSERT INTO user(name, lastname, username, email, password, phone, roleId, userRegionId)	VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
		$attributes = array($this->name, $this->lastname, $this->username, $this->email, $pwd, $this->phone, $this->roleId, $this->userRegionId);

		return  MySQLConnection::getInstance()->execute($query, $attributes);
	}

	public static function connect($username, $pwd){
		$pwd = sha1($pwd); //simple encryption. Use sha512 with Salt for better password encryption
		$query = "SELECT * FROM user WHERE username=? AND password=?";
		$attributes = array($username, $pwd);
		$result = MySQLConnection::getInstance()->execute($query, $attributes);
		
		if($result['status']=='error' || empty($result['result'])){
			return false;
		}

		$user = $result['result'][0];
		return new User($user['id'], $user['name'], $user['lastname'], $user['username'], $user['email'], $user['password'], $user['phone'], $user['roleId'], $user['userRegionId']);
	}
	
	public static function getUserRoles($roleId)
	{
	    $query = "SELECT * FROM user
                  LEFT JOIN role ON user.roleId = role.id
                  WHERE user.roleId=?";
	    
	    $attributes = array($roleId);
	    
	    $result = MySQLConnection::getInstance()->execute($query, $attributes);
	    
	    if($result['status']=='error' || empty($result['result'])){
	        return $result;
	    }
	    
	    $userRoles = $result['result'];
	    return $userRoles;
	}
	
	public static function getUserRegions($userRegionId)
	{
	    $query = "SELECT * FROM user
                  LEFT JOIN region ON user.userRegionId = region.regionId
                  WHERE user.userRegionId=?";
	    
	    $attributes = array($userRegionId);
	    
	    $result = MySQLConnection::getInstance()->execute($query, $attributes);
	    
	    if($result['status']=='error' || empty($result['result'])){
	        return $result;
	    }
	    
	    $regions = $result['result'];
	    return $regions;
	}
	
	public static function checkUsername($username)
	{
	    $query = "SELECT * FROM user WHERE username=?";
	    
	    $attributes = array($username);
	    
	    $result = MySQLConnection::getInstance()->getRows($query, $attributes);
	    
	    if($result >= 1)
	    {
	        return true;
	    }
	    else
	    {
	       return false;
	    }
	}
	
	public static function getAllUsers()
	{
	    $query = "SELECT * FROM user";
	    
	    $result = MySQLConnection::getInstance()->fetch($query);
	    
	    if($result['status']=='error' || empty($result['result'])){
	        return $result;
	    }
	    
	    $allusers = $result['result'];
	    return $allusers;
	}
	
	public static function getAllUserData()
	{
	    $query = "SELECT * FROM user
                  LEFT JOIN role ON user.roleId = role.id
                  LEFT JOIN region ON user.userRegionId = region.regionId";
	    
	    
	    $result = MySQLConnection::getInstance()->fetch($query);
	    
	    if($result['status']=='error' || empty($result['result'])){
	        return $result;
	    }
	    
	    $userdata = $result['result'];
	    return $userdata;
	}
	
	public static function deleteUser($id)
	{
	    $query = "DELETE FROM user WHERE id=?";
	    
	    $attributes = array($id);
	       
	    $result = MySQLConnection::getInstance()->execute($query, $attributes);
	    
	    if($result['status']=='error' || empty($result['result'])){
	        return $result;
	    }
	    
	    $userdeletion = $result['result'];
	    return $userdeletion;
	}
	
	
}
