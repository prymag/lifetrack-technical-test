<?php

namespace Prymag\Lifetrack;

use DateTime;

class Storage
{
    use DateTrait;

    protected $studies_per_day;

    protected $storage_cost_per_mb = 0.0001; // 0.10 USD / 1000

    protected $storage_usage_per_study = 10; // In MB

    public function __construct(int $studies_per_day, DateTime $date)
    {
        $this->studies_per_day = $studies_per_day;
        $this->date = $date;
    }

    public function getUsageThisMonth(): float
    {
        return $this->studies_per_day * $this->getDaysInMonth() * $this->storage_usage_per_study;
    }

    public function getCostThisMonth(): float
    {
        return $this->getUsageThisMonth() * $this->storage_cost_per_mb;
    }

    public function toArray(): array
    {
        return [
            'usage_this_month' => $this->getUsageThisMonth(),
            'cost_this_month' => $this->getCostThisMonth()
        ];
    }
}
