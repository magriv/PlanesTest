<?php

namespace App\Model\Airplane;

use App\Model\Surface\Surface;
use App\Model\Surface\Water;
use App\Model\Equipment\WeatherStationInterface;

class CurtissNC4 extends Airplane
{
    private const NAME = 'Curtiss NC4';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function canTakeoff(Surface $surface, WeatherStationInterface $weatherStation): bool
    {
        return $surface instanceof Water && $weatherStation->isGoodWeather() && $weatherStation->isDatetime();
    }

    protected function canLand(Surface $surface): bool
    {
        return $surface instanceof Water;
    }

}
