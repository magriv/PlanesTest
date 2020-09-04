<?php

namespace App\Model\Equipment;

interface WeatherStationInterface
{
    public function isGoodWeather(): bool;

    public function isDatetime(): bool;
}
