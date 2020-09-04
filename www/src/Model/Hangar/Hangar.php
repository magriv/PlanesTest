<?php

namespace App\Model\Hangar;

use App\Exception\AirplaneNotFoundException;
use App\Model\Airplane\AirplaneInterface;
use App\Repository\AirplaneRepositoryInterface;

class Hangar implements HangarInterface
{
    private string $name;

    private AirplaneRepositoryInterface $airplaneRepository;

    public function __construct(string $name, AirplaneRepositoryInterface $airplaneRepository)
    {
        $this->name = $name;
        $this->airplaneRepository = $airplaneRepository;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return AirplaneInterface[]
     */
    public function getAllAirplanes(): array
    {
        return $this->airplaneRepository->getAll();
    }

    public function placeIn(AirplaneInterface $airplane): HangarInterface
    {
        $this->airplaneRepository->add($airplane);

        return $this;
    }

    public function takeOut(string $airplaneClass): AirplaneInterface
    {
        $airplane = $this->airplaneRepository->findByType($airplaneClass);
        if (!$airplane) {
            throw new AirplaneNotFoundException(sprintf('Airplane with type %s not found', $airplaneClass));
        }

        return $airplane;
    }
}
