<?php require_once 'dal/MySQLConnection.php';

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

	public static function getStationsByRegion(){

		$query = "SELECT * FROM regionstations
				LEFT JOIN region ON regionstations.regionIdRS = region.regionId
				LEFT JOIN station ON regionstations.stationIdRS = station.stationId
				GROUP BY region.regionId, station.stationId
				ORDER BY station.stationName ASC
				";

		$result = MySQLConnection::getInstance()->fetch($query);

		if($result['status']=='error' || empty($result['result'])){
			return $result;
		}

		$stations = $result['result'];
		return $stations;

	}

    public static function deleteStationFromRegion($regionIdRS, $stationIdRS)
    {
        $query = "START TRANSACTION;
                  DELETE FROM regionstations WHERE regionIdRS=? AND stationIdRS=?;
                  DELETE FROM station WHERE stationId=?;
                  COMMIT;";
        
        $attributes = array($regionIdRS, $stationIdRS, $stationIdRS);
        
        return  MySQLConnection::getInstance()->execute($query, $attributes);
    }
    
    public static function modifyStationsForRegion($regionIdRS, $stationIdRS, $stationId, $stationName)
    {
        $query = "UPDATE regionstations SET regionIdRS=?, stationIdRS=?
                  WHERE stationIdRS=?;
                  UPDATE station SET stationId=?, stationName=?
                  WHERE stationId=?;";
        
        $attributes = array($regionIdRS, $stationId, $stationIdRS, $stationId, $stationName, $stationIdRS);
        
        return  MySQLConnection::getInstance()->transactions($query, $attributes);
    }
    public static function addStationsForRegion($regionId, $stationId, $stationName)
    {
        $query = "START TRANSACTION;
                  INSERT INTO regionstations(regionIdRS, stationIdRS) VALUES(?, ?);
                  INSERT INTO station(stationId, stationName) VALUES(?, ?);
                  COMMIT;";
        $attributes = array($regionId, $stationId, $stationId, $stationName);
        
        
        return MySQLConnection::getInstance()->execute($query, $attributes);
    }
}
