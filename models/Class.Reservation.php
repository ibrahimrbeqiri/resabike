<?php require_once 'dal/MySQLConnection.php';

class Reservation
{
    private $id;
    private $fromStation;
    private $toStation;
    private $nickname;
    private $nrBikes;
    
    

    public function __construct($id=null, $fromStation, $toStation, $nickname, $nrBikes){
        $this->setId($id);
        $this->setFromStation($fromStation);
        $this->setToStation($toStation);
        $this->setNickname($nickname);
        $this->setNrBikes($nrBikes);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getToStation()
    {
        return $this->toStation;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getNrBikes()
    {
        return $this->nrBikes;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setFromStation($fromStation)
    {
        $this->fromStation = $fromStation;
    }
    
    public function setToStation($toStation)
    {
        $this->toStation = $toStation;
    }
    
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }
    
    public function setNrBikes($nrBikes)
    {
        $this->nrBikes = $nrBikes;
    }
    public function insert(){
        
        $query = "INSERT INTO reservation(fromStation, toStation, nickname, nrBikes) VALUES (?, ?, ?, ?);";
        $attributes = array($this->fromStation, $this->toStation, $this->nickname, $this->nrBikes);
        
        return MySQLConnection::getInstance()->execute($query, $attributes);
    }
    

}

