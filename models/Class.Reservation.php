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
    public function addReservation()
    {
        $query = "INSERT INTO reservation(firstname, lastname, phone, email, bikenumber, reservationdate, 
        fromstation, tostation, departure, arrival, remarks) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $attributes = array($this->firstname, $this->lastname, $this->phone, $this->email, $this->bikenumber, 
            $this->reservationdate, $this->fromstation, $this->tostation, $this->departure, $this->arrival, $this->remarks);
        
        return  MySQLConnection::getInstance()->execute($query, $attributes);
    }
    
    public static function deleteReservation($id)
    {
        $query = "DELETE FROM reservation WHERE id=?";
        
        $attributes = array($id);
        
        return  MySQLConnection::getInstance()->execute($query, $attributes);
    }
    
    public static function getAllReservations()
    {
        $query = "SELECT * FROM reservation ORDER BY reservationdate DESC, departure DESC, fromstation ASC";
        
        $result = MySQLConnection::getInstance()->fetch($query);
        
        if($result['status']=='error' || empty($result['result'])){
            return $result;
        }
        
        $reservations = $result['result'];
        return $reservations;
    }

}

