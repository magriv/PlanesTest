<?php

namespace App\Model\Airplane;

use App\Exception\LandException;
use App\Exception\TakeoffException;
use App\Model\Equipment\WeatherStationInterface;
use App\Model\State\StateContext;
use App\Model\State\StateInterface;
use App\Model\Surface\Surface;

abstract class Airplane implements AirplaneInterface
{
    private StateContext $state;

    public function __construct()
    {
        $this->state = StateContext::create();
    }

    public function getState(): StateInterface
    {
        return $this->state->getState();
    }

    public function takeoff(Surface $surface, WeatherStationInterface $weatherStation): void
    {
        $this->state->takeoff();

        if (!$this->canTakeoff($surface, $weatherStation)) {
            throw new TakeoffException('Can\'t takeoff');
        }
    }

    public function fly(): void
    {
        $this->state->fly();
    }

    public function land(Surface $surface): void
    {
        $this->state->land();

        if (!$this->canLand($surface)) {
            throw new LandException('Can\'t land');
        }
    }

    abstract protected function canTakeoff(Surface $surface, WeatherStationInterface $weatherStation): bool;
    abstract protected function canLand(Surface $surface): bool;
}
