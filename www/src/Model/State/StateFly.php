<?php

namespace App\Model\State;

use App\Exception\FlyException;
use App\Exception\TakeoffException;

class StateFly implements StateInterface
{
    public function takeoff(StateContext $context): void
    {
        throw new TakeoffException('Should land');
    }

    public function fly(StateContext $context): void
    {
        throw new FlyException('Already fly');
    }

    public function land(StateContext $context): void
    {
        $context->setState(new StateLand());
    }

}