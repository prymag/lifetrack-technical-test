<?php

namespace Prymag\Lifetrack;

class Validator
{
    protected $errors = [];

    public function isValid(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function validate(array $request_inputs): void
    {
        if (!is_array($request_inputs)) {
            $this->errors[] = 'Invalid Request inputs';
        }

        $expected_keys = ['studies_per_day', 'study_growth', 'months_forecast'];
        $keys = array_keys($request_inputs);

        $missing = array_diff($expected_keys, $keys);

        if (count($missing)) {
            $this->errors[] = 'Missing inputs';
            return;
        }

        if ($request_inputs['studies_per_day'] == '' || $request_inputs['months_forecast'] == '') {
            $this->errors[] = 'Please fill up all the fields';
        }

        if (!is_int($request_inputs['studies_per_day'])) {
            $this->errors[] = 'Invalid studies per day value';
        }

        if ($request_inputs['study_growth'] != '' && !is_numeric($request_inputs['study_growth'])) {
            $this->errors[] = 'Invalid study growth value';
        }

        if (!is_int($request_inputs['months_forecast'])) {
            $this->errors[] = 'Invalid month forecast';
        }
    }
}
