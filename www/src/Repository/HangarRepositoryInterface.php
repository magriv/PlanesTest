<?php

namespace App\Repository;

use App\Model\Hangar\HangarInterface;

interface HangarRepositoryInterface
{
    public function add(HangarInterface $hangar): self;

    public function findByName(string $name): ?HangarInterface;
}
