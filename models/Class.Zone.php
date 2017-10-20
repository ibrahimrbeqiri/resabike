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
    
    public static function getZoneByName($name)
    {
       
        $query = "SELECT * FROM zone WHERE name=?";
        $attributes = array($name);
        $result = MySQLConnection::getInstance()->execute($query, $attributes);
        if($result['status']=='error' || empty($result['result'])){
            return $result;
        }
        
        $zone = $result['result'];
        return $zone;
    }
}

