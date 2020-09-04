<?php

namespace App\Model\State;

interface StateInterface
{
    public function takeoff(StateContext $context): void;

    public function fly(StateContext $context): void;

    public function land(StateContext $context): void;
}
