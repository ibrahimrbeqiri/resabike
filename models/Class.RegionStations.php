<?php

class RegionStations
{

    private $regionIdRS;
    private $stationIdRS;
    
    public function __construct($regionIdRS, $stationIdRS)
    {
        $this->setregionIdRS($regionIdRS);
        $this->setstationIdRS($stationIdRS);
    }
    
    public function getregionIdRS()
    {
        return $this->regionIdRS;
    }

    public function getStationIdRS()
    {
        return $this->stationIdRS;
    }

    public function setregionId($regionIdRS)
    {
        $this->regionIdRS = $regionIdRS;
    }

    public function setStationId($stationIdRS)
    {
        $this->stationIdRS = $stationIdRS;
    }
    
    public static function getAllRegionStations($regionId)
    {
        if($regionId == 1)
        {
            // if the user is global admin
            
            $query = "SELECT * FROM regionstations
                    LEFT JOIN region ON regionstations.regionIdRS = region.regionId
                    LEFT JOIN station ON regionstations.stationIdRS = station.stationId
                    ORDER BY station.stationName ASC";
        }
        else 
        {
            
            $query = "SELECT * FROM regionstations
                  LEFT JOIN region ON regionstations.regionIdRS = region.regionId
                  LEFT JOIN station ON regionstations.stationIdRS = station.stationId
                  WHERE region.regionId=?";
            
        }

        $attributes = array($regionId);
        
        $result = MySQLConnection::getInstance()->execute($query, $attributes);
        
        if($result['status']=='error' || empty($result['result'])){
            return $result;
        }
        
        $regionstations = $result['result'];
        return $regionstations;
    }
    
}
