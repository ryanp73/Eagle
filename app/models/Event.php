<?php

class Event
{
	/**
	 *    Array of the matches at the event
	 *    @var array
	 */
	private $_matches = array();
	/**
	 *    Array of the teams present at the event
	 *    @var array
	 */
	private $_teams = array();
	/**
	 *    Array of OPRs of each team at the event
	 *    Key is the team key, value is OPR
	 *    @var array
	 */
	private $_oprs = array();
	/**
	 *    Array of CCWMs of each team at the event
	 *    Key is the team key, value is CCWM
	 *    @var array
	 */
	private $_ccwms = array();
	/**
	 *    Array of DPRs of each team at the event
	 *    Key is the team key, value is DPR
	 *    @var array
	 */
	private $_dprs = array();

	/**
	 *    Constructor for the Event class
	 *    Sets the event key, base api url, and load basic info
	 *    @param String $eventKey Key for the event
	 */
	public function __construct($eventKey)
	{
		$this->eventKey = $eventKey;
		$this->apiBase = "event/" . $this->eventKey;
		$this->loadBasicInfo();
	}

	/**
	 *    Magic method to get property from class if no default method
	 *    @param  any $property Name of property to access
	 *    @return any           Value of property accessed
	 */
	public function __get($property)
	{
		if (isset($this->{$property})) 
		{
			return $this->{$property}; 
		}
		echo "Property undefined.";
	}

	/**
	 *    Gets and sets the basic info for an event
	 *    @return void
	 */
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

	/**
	 *    Gets and sets the team key of teams at the competition
	 *    @return void
	 */
	public function loadTeams()
	{
		$apiUrl = API_URL_BASE . $this->apiBase . "/teams" . API_URL_ENDING;
		$json = file_get_contents($apiUrl);
		$data = json_decode($json);
		foreach ($data as $team) {
			$this->_teams[] = $team->key;
		}
	}

	/**
	 *    Gets all of the team keys of the teams at the event
	 *    @return array All teams at the event
	 */
	public function getTeams()
	{
		return $this->_teams;
	}

	/**
	 *    Gets and sets the match key of matches at the competition
	 *    @return void
	 */
	public function loadMatches()
	{
		$apiUrl = API_URL_BASE . $this->apiBase . "/matches" . API_URL_ENDING;
		$json = file_get_contents($apiUrl);
		$data = json_decode($json);
		foreach ($data as $match) {
			$this->_matches[] = $match->key;
		}
	}

	/**
	 *    Gets all of the match keys of the matches at the event
	 *    @return array All matches at the event
	 */
	public function getMatches()
	{
		return $this->_matches;
	}

	/**
	 *    Gets and sets the OPRs, CCWMs, and DPRS of all teams at the event
	 *    @return void
	 */
	public function loadStats()
	{
		$apiUrl = API_URL_BASE . $this->apiBase . "/stats" . API_URL_ENDING;
		$json = file_get_contents($apiUrl);
		$data = json_decode($json);
		foreach ($data->oprs as $teamKey => $value) {
			$this->_oprs[$teamKey] = $value;
		}
		foreach ($data->ccwms as $teamKey => $value) {
			$this->_ccwms[$teamKey] = $value;
		}
		foreach ($data->dprs as $teamKey => $value) {
			$this->_dprs[$teamKey] = $value;
		}
	}

	/**
	 *    Gets the OPR for a team at the event
	 *    @param  string $teamKey Key for the team
	 *    @return float           Value of the OPR
	 */
	public function getOPR($teamKey)
	{
		return $this->_oprs[$teamKey];
	}

	/**
	 *    Gets the OPR of all teams at the event
	 *    @return array OPRs of all of the teams at the event
	 */
	public function getAllOPRs()
	{
		return $this->_oprs;
	}

	/**
	 *    Gets the CCWM for a team at the event
	 *    @param  string $teamKey Key for the team
	 *    @return float           Value of the CCWM
	 */
	public function getCCWM($teamKey)
	{
		return $this->_ccwms[$teamKey];
	}

	/**
	 *    Gets the CCWM of all teams at the event
	 *    @return array CCWMs of all of the teams at the event
	 */
	public function getAllCCWMs()
	{
		return $this->_ccwms;
	}

	/**
	 *    Gets the DPR for a team at the event
	 *    @param  string $teamKey Key for the team
	 *    @return float           Value of the DPR
	 */
	public function getDPR($teamKey)
	{
		return $this->_dprs[$teamKey];
	}

	/**
	 *    Gets the DPR of all teams at the event
	 *    @return array DPRs of all of the teams at the event
	 */
	public function getAllDPRs()
	{
		return $this->_dprs;
	}

	/**
	 *    Gets the OPR, CCWM, and DPR of a team at the competition
	 *    @param  string $teamKey Key of the team to look up
	 *    @return array           Array of the stats indexed by name
	 */
	public function getAllThreeStats($teamKey)
	{
		return array(
			'opr'  => $this->getOPR($teamKey),
			'ccwm' => $this->getCCWM($teamKey),
			'dpr'  => $this->getDPR($teamKey)
		);
	}
}