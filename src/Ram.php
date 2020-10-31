<?php

namespace Prymag\Lifetrack;

use DateTime;

class Ram
{
    use DateTrait;

    protected $ram_usage_per_study = 0.5; // 500 MB RAM / 1000 Studies

    protected $ram_cost_per_hour = 0.00000553; // 0.00553 USD / 1000 MB

    protected $studies_per_day;

    public function __construct(int $studies_per_day, DateTime $date)
    {
        $this->studies_per_day = $studies_per_day;
        $this->date = $date;
    }

    public function getUsagePerDay(): int
    {
        return $this->studies_per_day * $this->ram_usage_per_study;
    }

    public function getUsagePerHour(): float
    {
        return $this->getUsagePerDay() / 24;
    }

    public function getCostPerHour(): float
    {
        return $this->getUsagePerHour() * $this->ram_cost_per_hour ;
    }

    public function getCostPerDay(): float
    {
        return $this->getCostPerHour() * 24;
    }

    public function getCostThisMonth(): float
    {
        return $this->getDaysInMonth() * $this->getCostPerDay();
    }

    public function toArray()
    {
        return [
            'usage_per_day' => $this->getUsagePerDay(),
            'usage_per_hour' => $this->getUsagePerHour(),
            'cost_per_day' => $this->getCostPerDay(),
            'cost_this_month' => $this->getCostThisMonth()
        ];
    }
}
