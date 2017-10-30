<?php require_once 'dal/MySQLConnection.php';

class Region
{

    private $regionId;
    private $regionName;
    
    public function __construct($regionId=null, $regionName)
    {
        $this->setregionId($regionId);
        $this->setregionName($regionName);
    }
    
    public function getregionId()
    {
        return $this->regionId;
    }

    public function getregionName()
    {
        return $this->regionName;
    }

    public function setregionId($regionId)
    {
        $this->regionId = $regionId;
    }

    public function setregionName($regionName)
    {
        $this->regionName = $regionName;
    }
    
    public static function getAllRegions()
    {
       
        $query = "SELECT * FROM region";
        $result = MySQLConnection::getInstance()->fetch($query);
        
        if($result['status']=='error' || empty($result['result'])){
            return $result;
        }
        
        $regions = $result['result'];
        return $regions;
    }
    public static function addRegion()
    {
        $query = "INSERT INTO region(regionName) VALUES(?);";
        $attributes = array($this->regionName);
        
        return  MySQLConnection::getInstance()->execute($query, $attributes);
    }
    public static function deleteRegion($regionId)
    {
        $query = "DELETE FROM reservation WHERE regionId=?";
        
        $attributes = array($id);
        
        return  MySQLConnection::getInstance()->execute($query, $attributes);
    }
}

