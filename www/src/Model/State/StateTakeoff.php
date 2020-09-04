<?php

namespace App\Model\State;

use App\Exception\LandException;
use App\Exception\TakeoffException;

class StateTakeoff implements StateInterface
{
    public function takeoff(StateContext $context): void
    {
        throw new TakeoffException('Already takeoff');
    }

    public function fly(StateContext $context): void
    {
        $context->setState(new StateFly());
    }

    public function land(StateContext $context): void
    {
        throw new LandException('Should fly');
    }

}