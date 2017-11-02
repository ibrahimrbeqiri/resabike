<?php
require_once 'dal/MySQLConnection.php';
class Station{
    
	private $stationId;
	private $stationName;

	public function __construct($stationId, $stationName){
		$this->setstationId($stationId);
		$this->setstationName($stationName);
	}

	public function getstationId(){
		return $this->stationId;
	}
	
	public function getZone()
	{
	    $this->zone = $zone;
	}
	public function setstationId($stationId){
		$this->stationId = $stationId;
	}

	public function getstationName(){
		return $this->stationName;
	}

	public function setstationName($stationName){
		$this->stationName = $stationName;
	}
	
	public static function getAllStations()
	{
	    $query = "SELECT * FROM station";
	    $result = MySQLConnection::getInstance()->fetch($query);
	    
	    if($result['status']=='error' || empty($result['result'])){
	        return $result;
	    }
	    
	    $stations = $result['result'];
	    return $stations;
	}
	public static function getAllStationsWhere($stationId)
	{
	    $query = "SELECT * FROM station WHERE stationId=?";
	    $attributes = array($stationId);
	    $result = MySQLConnection::getInstance()->execute($query, $attributes);
	    
	    if($result['status']=='error' || empty($result['result'])){
	        return $result;
	    }
	    
	    $stations = $result['result'];
	    return $stations;
	}
}

?>
