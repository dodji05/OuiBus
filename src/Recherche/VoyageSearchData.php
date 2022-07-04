<?php

namespace App\Recherche;

class VoyageSearchData {
    private $depart;
    private $destination;
    private $date;
    

    /**
     * Get the value of depart
     */ 
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set the value of depart
     *
     * @return  self
     */ 
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get the value of destination
     */ 
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set the value of destination
     *
     * @return  self
     */ 
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}