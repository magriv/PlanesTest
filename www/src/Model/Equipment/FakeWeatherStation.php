<?php

namespace App\Model\Equipment;

class FakeWeatherStation implements WeatherStationInterface
{
    public function isGoodWeather(): bool
    {
        return true;
    }

    public function isDatetime(): bool
    {
        return true;
    }
}
