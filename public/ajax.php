<?php

require_once('../vendor/autoload.php');

use Prymag\Lifetrack\Forecaster;

$forecaster = new Forecaster();

$data = json_decode(file_get_contents('php://input'));
echo json_encode($data);
//echo json_encode($forecaster->run());
