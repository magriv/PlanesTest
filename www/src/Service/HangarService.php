<?php

namespace App\Service;

use App\Exception\HangarNotFoundException;
use App\Model\Airplane\AirplaneInterface;
use App\Repository\HangarRepositoryInterface;

class HangarService
{
    private HangarRepositoryInterface $hangarRepository;

    public function __construct(HangarRepositoryInterface $hangarRepository)
    {
        $this->hangarRepository = $hangarRepository;
    }

    /**
     * @param string $hangar
     *
     * @return AirplaneInterface[]
     * @throws HangarNotFoundException
     */
    public function getAirplanesByHangar(string $hangar): array
    {
        $hangar = $this->hangarRepository->findByName($hangar);
        if (!$hangar) {
            throw new HangarNotFoundException();
        }

        return $hangar->getAllAirplanes();
    }
}
