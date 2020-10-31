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

    /**
     * Run
     *
     * @param integer $no_of_studies
     * @param integer $months
     * @param float|null $growth_percent
     * @return self
     */
    public function run(int $no_of_studies, int $months, $growth_percent)
    {
        // Get the first day of this month that way adding 1 month to the date will have the desired effect
        $now = new DateTime('first day of this month');
        
        for ($x = 0; $x < $months; $x++) {
            $date = clone $now;
            $date->modify("+{$x} Month");
            
            $study = new Study($no_of_studies, $date);
            $study->setGrowthPercent($growth_percent);

            $this->studies[] = $study;
            $no_of_studies = $study->getStudiesPerDay();
        }
        return $this;
    }

    public function toArray(): array
    {
        $study_results = [];
        foreach ($this->studies as $study) {
            $study_results[] = [
                'studies_per_day' => $study->getStudiesPerDay(),
                'studies_in_month' => $study->getStudiesThisMonth(),
                'month_year' => $study->getMonthYear(),
                'ram' => $study->ram()->toArray(),
                'storage' => $study->storage()->toArray(),
                'total_cost' => $study->getTotaCostThisMonth(),
                'total_cost_formatted' => $study->getTotalCostThisMonthFormatted()
            ];
        }

        return $study_results;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
