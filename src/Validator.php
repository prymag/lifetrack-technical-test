<?php

namespace Prymag\Lifetrack;

class Validator
{
    protected $errors = [];

    public function isValid(): bool
    {
        return empty($errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function validate(int $studies_per_day, float $study_growth, int $months_forecast): void
    {
        if (empty($studies_per_day) || empty($study_growth) || empty($months_forecast)) {
            $this->errors[] = 'Please fill up all the fields';
        }

        if (!is_int($studies_per_day)) {
            $this->errors[] = 'Invalid studies per day value';
        }

        if (!is_float($study_growth)) {
            $this->errors[] = 'Invalid study growth value';
        }

        if (!is_int($months_forecast)) {
            $this->errors[] = 'Invalid month forecast';
        }
    }
}
