<?php

namespace Prymag\Lifetrack;

use DateTime;
use Prymag\Lifetrack\Study;

class Forecaster
{
    /**
     * @var Study[]
     */
    protected $studies = [];

    public function run(int $no_of_studies, int $months, float $growth_percent)
    {
        // Get the first day of this month that way adding 1 month to the date will have the desired effect
        $now = new DateTime('first day of this month');
        
        for ($x = 0; $x < $months; $x++) {
            $date = clone $now;
            $date->modify("+{$x} Month");
            
            $study = new Study($no_of_studies, $date);
            $study->setGrowthPercent($growth_percent);

            $this->studies[] = $study;
        }
        return $this;
    }

    public function toArray()
    {
        $study_results = [];
        foreach ($this->studies as $study) {
            $study_results[] = [
                'month_year' => $study->getMonthYear(),
                'ram' => $study->ram()->toArray(),
                'storage' => $study->storage()->toArray(),
                'total_cost' => $study->getTotaCostThisMonth(),
                'total_cost_formatted' => $study->getTotalCostThisMonthFormatted()
            ];
        }

        return $study_results;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
