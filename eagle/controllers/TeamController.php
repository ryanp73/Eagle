<?php

class TeamController
{
	public static function get(array $url)
	{
		if (count($url) == 2)
		{
			if ($url[0] == 'team')
			{
				if (Autoloader::loadModel('Team'))
				{
					$team = new Team($url[1]);
					View::make('TeamTemplate', $team);
				}
			}
		}
	}
}