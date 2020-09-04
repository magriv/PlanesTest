<?php

namespace App\Model\Airplane;

use App\Model\Surface\Runway;
use App\Model\Surface\Surface;
use App\Model\Equipment\WeatherStationInterface;

class Boeing747 extends Airplane
{
    private const NAME = 'Boeing 747';

    public function getName(): string
    {
        return self::NAME;
    }

    protected function canTakeoff(Surface $surface, WeatherStationInterface $weatherStation): bool
    {
        return $surface instanceof Runway;
    }

    protected function canLand(Surface $surface): bool
    {
        return $surface instanceof Runway;
    }
}
