<?php

namespace App\Services;

use Carbon\Carbon;

class AtmService
{
    private $dateTime;
    private $isVipCustomer;

    public function __construct($dateTime, $isVipCustomer = false)
    {
        $this->dateTime = $dateTime;
        $this->isVipCustomer = $isVipCustomer;
    }

    public function getFee(): int
    {
        $dateTime = Carbon::parse($this->dateTime);
        if ($this->isVipCustomer) {
            return 0;
        }
        if ($dateTime->isWeekend()) {
            return 110;
        }
        $time = $dateTime->format('H:i:s');
        if (($time >= '00:00:00' && $time <= '08:44:59') || ($time >= '18:00:00' && $time <= '23:59:59')) {
            return 110;
        } else {
            return 0;
        }
    }
}
