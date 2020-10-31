<?php

require_once('../vendor/autoload.php');

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    exit;
}

use Prymag\Lifetrack\Forecaster;
use Prymag\Lifetrack\Validator;

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $validator = new Validator();

    $validator->validate($data);

    if (!$validator->isValid()) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode([
            'success' => false,
            'error_type' => 'validation',
            'errors' => $validator->getErrors()
        ]);
        exit;
    }

    $forecaster = new Forecaster();
    $result = [
        'success' => true,
        'data' => $forecaster->run($data['studies_per_day'], $data['months_forecast'], $data['study_growth'])->toArray()
    ];
    echo json_encode($result);
} catch (\Exception $e) {
    $result = [
        'success' => false,
        'error_type' => 'exception',
        'error' => 'An error occured'
    ];
    // Log
}
