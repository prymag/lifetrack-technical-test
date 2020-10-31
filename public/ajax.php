<?php

require_once('../vendor/autoload.php');

use Prymag\Lifetrack\Forecaster;
use Prymag\Lifetrack\Validator;

try {
    $data = json_decode(file_get_contents('php://input'), true);

    /* $data = [
        'studies_per_day' => 10000,
        'study_growth' => 1,
        'months_forecast' => 3
    ]; */
    $validator = new Validator();

    $validator->validate($data);

    if (!$validator->isValid()) {
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
