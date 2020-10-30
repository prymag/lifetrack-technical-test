<?php

require_once('../vendor/autoload.php');

use Prymag\Lifetrack\Forecaster;

$forecaster = new Forecaster();

echo json_encode($forecaster->run());
