<?php

namespace LaravelTool\EloquentExternalEventsServer\Traits;

trait EventServer
{
    public function fireEvent($event, $halt)
    {
        return $this->fireModelEvent($event, $halt);
    }
}