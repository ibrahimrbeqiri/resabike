<?php require_once 'dal/MySQLConnection.php';

class Zone
{

    private $id;
    private $name;
    
    public function __construct($id=null, $name)
    {
        $this->setId($id);
        $this->setName($name);
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    
    public static function getAllZones()
    {
       
        $query = "SELECT * FROM zone";
        $result = MySQLConnection::getInstance()->fetch($query);
        
        if($result['status']=='error' || empty($result['result'])){
            return $result;
        }
        
        $zones = $result['result'];
        return $zones;
    }
}

