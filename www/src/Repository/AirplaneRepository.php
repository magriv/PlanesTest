<?php

namespace App\Repository;


use App\Model\Airplane\AirplaneInterface;

class AirplaneRepository implements AirplaneRepositoryInterface
{
    /**
     * @var AirplaneInterface[]
     */
    private array $airplanes = [];

    public function add(AirplaneInterface $airplane): self
    {
        $this->airplanes[] = $airplane;

        return $this;
    }

    /**
     * @return AirplaneInterface[]
     */
    public function getAll(): array
    {
        return $this->airplanes;
    }

    public function findByType(string $airplaneClass): ?AirplaneInterface
    {
        foreach ($this->airplanes as $airplane) {
            if ($airplane instanceof $airplaneClass) {
                return $airplane;
            }
        }

        return null;
    }
}
