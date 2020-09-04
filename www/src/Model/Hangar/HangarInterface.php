<?php

namespace App\Model\Hangar;

use App\Model\Airplane\AirplaneInterface;

interface HangarInterface
{
    public function getName(): string;

    public function takeOut(string $airplaneClass): AirplaneInterface;

    public function placeIn(AirplaneInterface $airplane): self;

    /**
     * @return AirplaneInterface[]
     */
    public function getAllAirplanes(): array;
}
