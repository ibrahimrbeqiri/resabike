<?php


class Line
{
    private $id;
    private $name;
    private $number;
    private $fromstation;
    private $tostation;
    private $driver;
    

    public function __construct()
    {
        
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getFromstation()
    {
        return $this->fromstation;
    }

    public function getTostation()
    {
        return $this->tostation;
    }

    public function getDriver(User $driver)
    {
        $this->$driver->getId();
        return $this->$driver;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setFromstation($fromstation)
    {
        $this->fromstation = $fromstation;
    }

    public function setTostation($tostation)
    {
        $this->tostation = $tostation;
    }

    public function setDriver(User $driver)
    {
        $this->$driver->setId($id);
    }

}

