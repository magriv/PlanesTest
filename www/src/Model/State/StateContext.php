<?php

namespace App\Model\State;

class StateContext
{
    private StateInterface $state;

    public static function create(): self
    {
        $context = new self();
        $context->state = new StateLand();

        return $context;
    }

    public function getState(): StateInterface
    {
        return $this->state;
    }

    public function setState(StateInterface $state): void
    {
        $this->state = $state;
    }

    public function takeoff(): void
    {
        $this->state->takeoff($this);
    }

    public function fly(): void
    {
        $this->state->fly($this);
    }

    public function land(): void
    {
        $this->state->land($this);
    }
}
