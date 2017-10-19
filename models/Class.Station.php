<?php
require_once 'dal/MySQLConnection.php';
class Station{
	private $id;
	private $name;

	public function __construct($id, $firstname){
		$this->setId($id);
		$this->setName($firstname);
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

public static function getStations(/* Add region name here later */){
		$station = "station";
		$query = "SELECT * FROM station";
		$attributes = array($station);
		$result = MySQLConnection::getInstance()->fetch($query);
		if($result['status']=='error' || empty($result['result'])){
			return $result;
		}

		$stations = $result['result'];
		return $stations;
	}
}

?>
