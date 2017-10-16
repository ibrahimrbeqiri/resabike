<?php require_once 'dal/MySQLConnection.php';

class Reservation
{
    private $id;
    private $from;
    private $to;
    private $nickname;
    private $nrBikes;
    
    

    public function __construct($id=null, $from, $to, $nickname, $nrBikes){
        $this->setId($id);
        $this->setFrom($from);
        $this->setTo($to);
        $this->setNickname($nickname);
        $this->setNrBikes($nrBikes);
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setFrom($from)
    {
        $this->from = $from;
    }
    
    public function setTo($to)
    {
        $this->to = $to;
    }
    
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }
    
    public function setNrBikes($nrBikes)
    {
        $this->nrBikes = $nrBikes;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getNrBikes()
    {
        return $this->nrBikes;
    }
    
    public function insert(){
        
        $query = "INSERT INTO reservation(from, to, nickname, nrBikes) VALUES (?, ?, ?, ?);";
        $attributes = array($this->from, $this->to, $this->nickname, $this->nrBikes);
        
        return MySQLConnection::getInstance()->execute($query, $attributes);
    }
    

}

