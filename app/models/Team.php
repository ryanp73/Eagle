<?php

class Team extends Model 
{

    public $teamId;
    public $nickname;
    public $events;
    public $lastUpdated;

    public function __construct()
    {
    	$this->events = explode("|", $this->events);
    }

}