<?php

namespace App\Service\Response;

use App\DTO\Response\AirplaneDTO;
use App\Model\Airplane\AirplaneInterface;

class AirplaneDTOFactory
{
    /**
     * @param AirplaneInterface[] $airplanes
     *
     * @return AirplaneDTO[]
     */
    public function createFromList(array $airplanes): array
    {
        return array_map([$this, 'create'], $airplanes);
    }

    private function create(AirplaneInterface $airplane): AirplaneDTO
    {
        return new AirplaneDTO($airplane->getName());
    }
}
