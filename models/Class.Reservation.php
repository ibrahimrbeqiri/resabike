<?php require_once 'dal/MySQLConnection.php';

class Reservation
{
    private $id;
    private $firstname;
    private $lastname;
    private $phone;
    private $email;
    private $bikenumber;
    private $groupname;
    private $reservationdate;
    private $departure;
    private $arrival;
    private $remarque;
    private $fromstation;
    private $tostation;
    
    
    public function __construct($id=null, $firstname, $lastname, $phone, $email, $bikenumber, $groupname, $reservationdate, 
        $departure, $arrival, $remarque, $fromstation, $tostation)
    {
        $this->setId($id);
        $this->setFirstName($firstname);
        $this->setLastName($lastname);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setBikeNumber($bikenumber);
        $this->setGroupName($groupname);
        $this->setReservationDate($reservationdate);
        $this->setDeparture($departure);
        $this->setArrival($arrival);
        $this->setRemarque($remarque);
        $this->setFromStation($fromstation);
        $this->setToStation($tostation);
        
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

    public function getGroupName()
    {
        return $this->groupname;
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

    public function getRemarque()
    {
        return $this->remarque;
    }

    public function getFromStation()
    {
        return $this->fromstation;
    }

    public function getToStation()
    {
        return $this->tostation;
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

    public function setGroupName($groupname)
    {
        $this->groupname = $groupname;
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

    public function setRemarque($remarque)
    {
        $this->remarque = $remarque;
    }

    public function setFromStation($fromstation)
    {
        $this->fromstation = $fromstation;
    }

    public function setToStation($tostation)
    {
        $this->tostation = $tostation;
    }



}

