<?php

namespace LaravelTool\EloquentExternalEventsServer\Traits;

trait EventServer
{
    public function fireEvent($event, $attributes, $originals, $changes, $halt)
    {
        $this->attributes = $attributes;
        $this->originals = $originals;
        $this->changes = $changes;

        return $this->fireModelEvent($event, $halt);
    }
}