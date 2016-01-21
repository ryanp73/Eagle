<?php

require_once "./app/core/Loader.php";

Loader::loadCore();

$app = new App();

$app->run();