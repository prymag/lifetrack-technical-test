<?php

namespace Prymag\Lifetrack;

use DateTime;

trait DateTrait
{
    protected $date;

    public function getDaysInMonth(): int
    {
        return intval($this->date->format('t'));
    }

    public function getMonthYear()
    {
        return $this->date->format('F Y');
    }
}
