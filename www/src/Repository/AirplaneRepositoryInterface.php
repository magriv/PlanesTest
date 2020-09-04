<?php

namespace App\Repository;

use App\Model\Airplane\AirplaneInterface;

interface AirplaneRepositoryInterface
{
    public function add(AirplaneInterface $airplane): self;

    /**
     * @return AirplaneInterface[]
     */
    public function getAll(): array;

    public function findByType(string $airplaneClass): ?AirplaneInterface;
}
