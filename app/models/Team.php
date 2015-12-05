<?php

class Team 
{
    private $_events = array();

    public function __construct($teamNumber) 
    {
        $this->teamNumber = $teamNumber;
        $this->teamKey = "frc" + $this->teamNumber;
        $this->apiBase = "team/" . $this->teamKey;
        $this->loadBasicInfo();
    }

    public function __get($property)
    {
        if (isset($this->{$property})) 
        {
            return $this->{$property}; 
        }
        echo "Property undefined.";
    }

    public function loadBasicInfo()
    {
        $apiUrl = API_URL_BASE . $this->apiBase . API_URL_ENDING;
        $json = file_get_contents($apiUrl);
        $data = json_decode($json);
        foreach ($data as $key => $value)
        {
            $this->{$key} = $value;
        }
    }

    public function loadEvents($year = 2015) 
    {
        $apiUrl = API_URL_BASE . $this->apiBase . "/{$year}/events" . API_URL_ENDING;
        $json = file_get_contents($apiUrl);
        $data = json_decode($json);
        foreach ($data as $event) {
            $this->_events[$event->key] = $event->name;
        }
    }

    public function loadMatchFromEvent()
    {

    }

    public function getEvents()
    {
        return $this->_events;
    }
}