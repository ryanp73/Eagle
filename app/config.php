<?php

define('VERSION', '0.0.1');
define('API_URL_BASE', 'https://www.thebluealliance.com/api/v2/');
define('API_URL_ENDING', '?X-TBA-App-Id=frc2410:scouting-ryan:' . VERSION);

require_once './app/models/Team.php';
require_once './app/models/Event.php';
require_once './app/models/Match.php';