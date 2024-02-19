<?php

namespace LaravelTool\EloquentExternalEventsServer\Traits;

trait EventServer
{
    public function fireEvent($event, $attributes, $original, $changes, $halt)
    {
        $this->attributes = $attributes;
        $this->original = $original;
        $this->changes = $changes;

        return $this->fireModelEvent($event, $halt);
    }
}