<?php

namespace App\Repository;

use App\Model\Hangar\HangarInterface;

class HangarRepository implements HangarRepositoryInterface
{
    /**
     * @var HangarInterface[]
     */
    private array $hangars = [];

    public function add(HangarInterface $hangar): self
    {
        $this->hangars[] = $hangar;

        return $this;
    }

    public function findByName(string $name): ?HangarInterface
    {
        $name = strtolower($name);
        foreach ($this->hangars as $hangar) {
            if (strtolower($hangar->getName()) === $name) {
                return $hangar;
            }
        }

        return null;
    }
}
