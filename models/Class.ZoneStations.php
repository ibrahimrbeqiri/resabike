<?php

class ZoneStations
{

    private $zoneId;
    private $stationId;
    
    public function __construct()
    {
        
    }
    
    public function getZoneId()
    {
        return $this->zoneId;
    }

    public function getStationId()
    {
        return $this->stationId;
    }

    public function setZoneId(Zone $zoneId)
    {
        $this->zoneId = $zoneId;
    }

    public function setStationId(Station $stationId)
    {
        $this->stationId = $stationId;
    }
    
    public static function getAllZoneStations($zoneId)
    {
        $query = "SELECT * FROM zonestations
                  LEFT JOIN zone ON zonestations.zoneId = zone.id
                  LEFT JOIN station ON zonestations.stationId = station.id
                  WHERE zone.id=?";
        
        $attributes = array($zoneId);
        
        $result = MySQLConnection::getInstance()->execute($query, $attributes);
        
        if($result['status']=='error' || empty($result['result'])){
            return $result;
        }
        
        $zonestations = $result['result'];
        return $zonestations;
    }
    
}

