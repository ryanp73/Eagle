<?php

class Match
{
    /**
     *     Key from The Blue Alliance API for this match 
     *     @var string
     */
    public $matchKey;

    /**
     *     Base part of the URL used to access the TBA API for this match
     *     @var string
     */
    private $_apiBase;

	public function __construct($matchKey)
	{
		$this->matchKey = $matchKey;
		$this->_apiBase = "match/{$this->matchKey}";
		$this->loadMatchInfo();
	}

	public function loadMatchInfo()
    {
        $apiUrl = API_URL_BASE . $this->_apiBase . API_URL_ENDING;
        $json = file_get_contents($apiUrl);
        $data = json_decode($json);
        foreach ($data as $key => $value)
        {
            $this->{$key} = $value;
        }
    }
}