<?php

namespace App\Model\Airplane;

use App\Model\State\StateInterface;
use App\Model\Surface\Surface;
use App\Model\Equipment\WeatherStationInterface;

interface AirplaneInterface
{
    public function getName(): string;

    public function getState(): StateInterface;

    public function takeoff(Surface $surface, WeatherStationInterface $weatherStation): void;

    public function fly(): void;

    public function land(Surface $surface): void;
}

