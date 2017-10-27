<?php require_once 'dal/MySQLConnection.php';

class Region
{

    private $regionregionId;
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
}

