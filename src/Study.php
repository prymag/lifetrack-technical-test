<?php

namespace Prymag\Lifetrack;

use DateTime;
use NumberFormatter;

class Study
{
    use DateTrait;
    
    protected $growth_percent;

    protected $ram;

    protected $studies_per_day;

    protected $storage;

    public function __construct(
        int $studies_per_day,
        DateTime $date
    ) {
        $this->studies_per_day = $studies_per_day;
        $this->date = $date;
    }

    /**
     * @param float|null $growth_percent
     * @return self
     */
    public function setGrowthPercent($growth_percent)
    {
        $this->growth_percent = $growth_percent;
        return $this;
    }

    public function getStudiesPerDay(): int
    {
        if ($this->growth_percent) {
            return $this->getStudyGrowth();
        }

        return $this->studies_per_day;
    }

    public function getStudiesThisMonth(): int
    {
        return $this->getStudiesPerDay() * $this->getDaysInMonth();
    }

    public function getStudyGrowth(): int
    {
        return ceil(round(($this->studies_per_day * ($this->growth_percent / 100)) + $this->studies_per_day));
    }

    public function ram(): Ram
    {
        if (!$this->ram) {
            $this->ram = new Ram($this->getStudiesPerDay(), $this->date);
        }

        return $this->ram;
    }

    public function storage(): Storage
    {
        if (!$this->storage) {
            $this->storage = new Storage($this->getStudiesPerDay(), $this->date);
        }

        return $this->storage;
    }

    public function getTotaCostThisMonth(): float
    {
        return  $this->storage()->getCostThisMonth() + $this->ram()->getCostThisMonth();
    }

    public function getTotalCostThisMonthFormatted(): string
    {
        $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        return $fmt->formatCurrency($this->getTotaCostThisMonth(), 'USD');
    }
}
