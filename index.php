<?php

require_once 'app/config.php';

$kc = new Event('2015mokc');
$kc->loadStats();
print_r($kc->getAllThreeStats(2410));