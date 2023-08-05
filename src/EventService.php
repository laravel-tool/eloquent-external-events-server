<?php

namespace LaravelTool\EloquentExternalEventsServer;

use Illuminate\Database\Eloquent\Model;

class EventService
{
    public function dispatch(string $event, string $modelType, mixed $modelId, bool $halt)
    {
        /** @var Model $model */
        $model = $modelType::find($modelId);
        if (method_exists($model, 'fireEvent')) {
            return $model->fireEvent($event, $halt);
        }
        return [];
    }
}