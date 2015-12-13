<?php

class Team 
{
    /**
     *    List of all the events the team attends
     *    @var array
     */
    private $_events = array();

    /**
     *    Team number
     *    @var int
     */
    public $teamNumber;

    /**
     *    Key for the team in the form frc0000
     *    @var string
     */
    public $teamKey;

    /**
     *    Base url for the TBA API
     *    @var string
     */
    private $__apiBase;

    /**
     *    Constructor for the Team class
     *    Sets team number, key, and api url from parameter
     *    @param int $teamNumber Team number
     */
    public function __construct($teamNumber) 
    {
        $this->teamNumber = $teamNumber;
        $this->teamKey = "frc" . $this->teamNumber;
        $this->_apiBase = "team/" . $this->teamKey;
        $this->loadBasicInfo();
    }

    /**
     *    Gets basic team info from the TBA API
     *    @return void
     */
    private function loadBasicInfo()
    {
        $apiUrl = API_URL_BASE . $this->_apiBase . API_URL_ENDING;
        $json = file_get_contents($apiUrl);
        $data = json_decode($json);
        foreach ($data as $key => $value)
        {
            $this->{$key} = $value;
        }
    }

    /**
     *    Loads all competitions the team has gone to
     *    @param  int $year The year to get competitions for
     *    @return void
     */
    public function loadEvents($year = 2015) 
    {
        $apiUrl = API_URL_BASE . $this->_apiBase . "/{$year}/events" . API_URL_ENDING;
        $json = file_get_contents($apiUrl);
        $data = json_decode($json);
        foreach ($data as $event) {
            $this->_events[$event->key] = $event->name;
        }
    }

    public function loadMatchFromEvent()
    {

    }

    /**
     *    Gets the events that the teams has attended
     *    @return array Array of events attended
     */
    public function getEvents()
    {
        if (!count($this->_events))
        {
            $this->loadEvents();
        }

        return $this->_events;
    }
}