<?php

return array(
	'/\/team\/[0-9]{1,4}/' => 'TeamController#get#number',
	'/(.)*/' => 'IndexController#get'
);