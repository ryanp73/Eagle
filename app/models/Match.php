<?php

class Match
{
	public function __construct($matchKey)
	{
		$this->matchKey = $matchKey;
		$this->apiBase = "match/{$this->matchKey}";
		$this->loadMatchInfo();
	}

	public function loadMatchInfo()
    {
        $apiUrl = API_URL_BASE . $this->apiBase . API_URL_ENDING;
        $json = file_get_contents($apiUrl);
        $data = json_decode($json);
        foreach ($data as $key => $value)
        {
            $this->{$key} = $value;
        }
    }
}