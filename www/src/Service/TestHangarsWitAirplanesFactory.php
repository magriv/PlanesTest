<?php

namespace App\Service;

use App\Model\Airplane\AeropraktA24;
use App\Model\Airplane\Boeing747;
use App\Model\Airplane\CurtissNC4;
use App\Model\Hangar\Hangar;
use App\Repository\AirplaneRepository;
use App\Repository\AirplaneRepositoryInterface;
use App\Repository\HangarRepository;
use App\Repository\HangarRepositoryInterface;

class TestHangarsWitAirplanesFactory
{
    public function create(): HangarRepositoryInterface
    {
        $airplaneRepository = $this->createAirplanes();

        $hangar = new Hangar('Aeroprakt', $airplaneRepository);

        $hangarRepository = new HangarRepository();
        $hangarRepository->add($hangar);

        return $hangarRepository;
    }

    private function createAirplanes(): AirplaneRepositoryInterface
    {
        $airplaneRepository = new AirplaneRepository();

        for ($i=0; $i<5; $i++) {
            $airplaneRepository->add(new AeropraktA24());
        }
        for ($i=0; $i<3; $i++) {
            $airplaneRepository->add(new CurtissNC4());
        }
        for ($i=0; $i<2; $i++) {
            $airplaneRepository->add(new Boeing747());
        }

        return $airplaneRepository;
    }
}
