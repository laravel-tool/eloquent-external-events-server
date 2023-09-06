<?php

namespace LaravelTool\EloquentExternalEventsServer\Traits;

trait EventServer
{
    public function fireEvent($event, $changes, $halt)
    {
        $this->changes = $changes;

        return $this->fireModelEvent($event, $halt);
    }
}