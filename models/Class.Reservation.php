<?php require_once 'dal/MySQLConnection.php';

class Reservation
{
    private $id;
    private $firstname;
    private $lastname;
    private $phone;
    private $email;
    private $bikenumber;
    private $reservationdate;
    private $departure;
    private $arrival;
    private $remarks;
    private $fromstation;
    private $tostation;
    private $creationDate;


    public function __construct($id=null, $firstname, $lastname, $phone, $email, $bikenumber, $reservationdate, $fromstation, $tostation,
        $departure, $arrival, $remarks, $creationDate=null)
    {
        $this->setId($id);
        $this->setFirstName($firstname);
        $this->setLastName($lastname);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setBikeNumber($bikenumber);
        $this->setReservationDate($reservationdate);
        $this->setDeparture($departure);
        $this->setArrival($arrival);
        $this->setRemarks($remarks);
        $this->setFromStation($fromstation);
        $this->setToStation($tostation);
        $this->setCreationDate($creationDate);

    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getBikeNumber()
    {
        return $this->bikenumber;
    }

    public function getReservationDate()
    {
        return $this->reservationdate;
    }

    public function getDeparture()
    {
        return $this->departure;
    }

    public function getArrival()
    {
        return $this->arrival;
    }

    public function getRemarks()
    {
        return $this->remarks;
    }

    public function getFromStation()
    {
        return $this->fromstation;
    }

    public function getToStation()
    {
        return $this->tostation;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setBikeNumber($bikenumber)
    {
        $this->bikenumber = $bikenumber;
    }

    public function setReservationDate($reservationdate)
    {
        $this->reservationdate = $reservationdate;
    }

    public function setDeparture($departure)
    {
        $this->departure = $departure;
    }

    public function setArrival($arrival)
    {
        $this->arrival = $arrival;
    }

    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;
    }

    public function setFromStation($fromstation)
    {
        $this->fromstation = $fromstation;
    }

    public function setToStation($tostation)
    {
        $this->tostation = $tostation;
    }
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

	public static function checkStations($from, $to)
	{
		$query = "SELECT DISTINCT * FROM station WHERE stationName IN (?,?);";
		$attributes = array($from, $to);
		$result = MySQLConnection::getInstance()->execute($query, $attributes);
		if($result['status']=='error' ){
			return $result;
		}
		//if stations not found or if only one of the stations is found -> fail
		elseif (empty($result['result']) ) {
			return false;
		}
		elseif (count($result['result']) <= 1) {
			return "one not found";
		}

		$stations = $result['result'];
		return $stations;

	}

	public static function checkRegions($from, $to)
	{
		$query = "SELECT s1.stationId, s1.stationName, rs1.regionIdRS as Region1, s2.stationId, s2.stationName, rs2.regionIdRS as Region2
				FROM (resabike.station AS s1, resabike.station AS s2)
				JOIN regionstations rs1 ON (s1.stationId = rs1.stationIdRS and s1.stationName = ?)
				JOIN regionstations rs2 ON (s2.stationId = rs2.stationIdRS and s2.stationName = ?)
				WHERE rs1.regionIdRS = rs2.regionIdRS";
		$attributes = array($from, $to);
		$result = MySQLConnection::getInstance()->execute($query, $attributes);
		if($result['status']=='error' ){
			return $result;
		}
		elseif (empty($result['result'])) {
			return false;
		}

		$stations = $result['result'];
		return $stations;

	}

    public function addReservation()
    {
        $query = "INSERT INTO reservation(firstname, lastname, phone, email, bikenumber, reservationdate,
        fromstation, tostation, departure, arrival, remarks) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $attributes = array($this->firstname, $this->lastname, $this->phone, $this->email, $this->bikenumber,
            $this->reservationdate, $this->fromstation, $this->tostation, $this->departure, $this->arrival, $this->remarks);


        return MySQLConnection::getInstance()->insertReservation($query, $attributes);

    }

    public static function deleteReservation($id)
    {
        $query = "DELETE FROM reservation WHERE id=?";

        $attributes = array($id);

        return  MySQLConnection::getInstance()->execute($query, $attributes);
    }

    public static function modifyReservation($firstname, $lastname, $phone, $email, $bikenumber, $reservationdate, $fromstation, $tostation,
        $departure, $arrival, $remarks, $id)
    {
        $query = "UPDATE reservation SET firstname=?, lastname=?, phone=?, email=?, bikenumber=?, reservationdate=?, fromstation=?, tostation=?,
                                        departure=?, arrival=?, remarks=?
                                     WHERE id=?";

        $attributes = array($firstname, $lastname, $phone, $email, $bikenumber, $reservationdate, $fromstation, $tostation,
            $departure, $arrival, $remarks, $id);

        return  MySQLConnection::getInstance()->execute($query, $attributes);
    }

    public static function getAllReservations($reservationdate)
    {
        if($reservationdate == null)
        {
            $query = "SELECT * , fromplace.stationName as stationFrom, toplace.stationName AS stationTo FROM reservation
                                JOIN station AS fromplace
                                ON reservation.fromstation = fromplace.stationId
                                JOIN station AS toplace
                                ON reservation.tostation = toplace.stationId
                                ORDER BY departure DESC, reservationdate DESC";

            $result = MySQLConnection::getInstance()->fetch($query);
        }
        else
        {
            $query = "SELECT * , fromplace.stationName as stationFrom, toplace.stationName AS stationTo FROM reservation
                                JOIN station AS fromplace
                                ON reservation.fromstation = fromplace.stationId
                                JOIN station AS toplace
                                ON reservation.tostation = toplace.stationId
                                WHERE reservationdate=?
                                ORDER BY departure DESC, reservationdate DESC";

            $attributes = array($reservationdate);

            $result = MySQLConnection::getInstance()->execute($query, $attributes);
        }


        if($result['status']=='error' || empty($result['result'])){
            return null;
        }

        $reservations = $result['result'];
        return $reservations;
    }

    public static function getRegionAdminReservations($reservationdate, $regionIdRS)
    {
        if($reservationdate == null)
        {
            $query = "SELECT *, fromplace.stationName as stationFrom, toplace.stationName AS stationTo FROM reservation
                            JOIN station AS fromplace
                            ON reservation.fromstation = fromplace.stationId
                            JOIN station AS toplace
                            ON reservation.tostation = toplace.stationId
                            JOIN regionstations AS rs
							ON fromplace.stationId = rs.stationIdRS
                            JOIN region
                            ON rs.regionIdRS = region.regionId
                            WHERE rs.regionIdRS=?";

            $attributes = array($regionIdRS);

            $result = MySQLConnection::getInstance()->execute($query, $attributes);
        }
        else
        {
            $query = "SELECT *, fromplace.stationName as stationFrom, toplace.stationName AS stationTo FROM reservation
                            JOIN station AS fromplace
                            ON reservation.fromstation = fromplace.stationId
                            JOIN station AS toplace
                            ON reservation.tostation = toplace.stationId
                            JOIN regionstations AS rs
							ON fromplace.stationId = rs.stationIdRS
                            JOIN region
                            ON rs.regionIdRS = region.regionId
                            WHERE reservationdate=? AND rs.regionIdRS=?";

            $attributes = array($reservationdate, $regionIdRS);

            $result = MySQLConnection::getInstance()->execute($query, $attributes);
        }


        if($result['status']=='error' || empty($result['result'])){
            return null;
        }

        $reservations = $result['result'];
        return $reservations;
    }

    public static function getAllBusDriverReservations($reservationdate)
    {
        $query = 			"SELECT *, fromplace.stationName as stationFrom, toplace.stationName AS stationTo
							FROM reservation
                            JOIN station AS fromplace
                            ON reservation.fromstation = fromplace.stationId
                            JOIN station AS toplace
                            ON reservation.tostation = toplace.stationId
                            WHERE reservationdate=?
                            ORDER BY departure ASC, reservationdate DESC";

        $attributes = array($reservationdate);

        $result = MySQLConnection::getInstance()->execute($query, $attributes);

        if($result['status']=='error' || empty($result['result'])){
            return null;
        }

        $reservations = $result['result'];
        return $reservations;
    }

    public static function getBusDriverReservations($reservationdate, $regionIdRS)
    {
        $query = 			"SELECT *, fromplace.stationName as stationFrom, toplace.stationName AS stationTo 
							FROM reservation
                            JOIN station AS fromplace
                            ON reservation.fromstation = fromplace.stationId
                            JOIN station AS toplace
                            ON reservation.tostation = toplace.stationId
                            JOIN regionstations AS rs
							ON fromplace.stationId = rs.stationIdRS
                            JOIN region
                            ON rs.regionIdRS = region.regionId
                            WHERE reservationdate=? AND rs.regionIdRS=?
                            ORDER BY departure ASC, reservationdate DESC";

        $attributes = array($reservationdate, $regionIdRS);

        $result = MySQLConnection::getInstance()->execute($query, $attributes);

        if($result['status']=='error' || empty($result['result'])){
            return null;
        }

        $reservations = $result['result'];
        return $reservations;
    }



}
