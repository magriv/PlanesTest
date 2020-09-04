<?php

namespace App\Model\State;

use App\Exception\FlyException;
use App\Exception\LandException;

class StateLand implements StateInterface
{
    public function takeoff(StateContext $context): void
    {
        $context->setState(new StateTakeoff());
    }

    public function fly(StateContext $context): void
    {
        throw new FlyException('Should land');
    }

    public function land(StateContext $context): void
    {
        throw new LandException('Already land');
    }

}