<?php

class ReservationStations
{
    
    private $stationId;
    private $reservationId;
    
    public function __construct()
    {
        
    }
    
    public function getStationId()
    {
        return $this->stationId;
    }

    public function getReservationId()
    {
        return $this->reservationId;
    }

    public function setStationId(Station $station)
    {
        $this->stationId = $station->id;
    }

    public function setReservationId(Reservation $reservation)
    {
        $this->reservationId = $reservation->id;
    }

}

