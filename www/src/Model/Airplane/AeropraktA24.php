<?php

namespace App\Model\Airplane;

use App\Model\Surface\Runway;
use App\Model\Surface\Surface;
use App\Model\Surface\Water;
use App\Model\Equipment\WeatherStationInterface;

class AeropraktA24 extends Airplane
{
    private const NAME = 'Aeroprakt A-24';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function canTakeoff(Surface $surface, WeatherStationInterface $weatherStation): bool
    {
        $isSurfaceGood = $surface instanceof Runway || $surface instanceof Water;

        return $isSurfaceGood && $weatherStation->isGoodWeather() && $weatherStation->isDatetime();
    }

    protected function canLand(Surface $surface): bool
    {
        return $surface instanceof Runway || $surface instanceof Water;
    }
}
