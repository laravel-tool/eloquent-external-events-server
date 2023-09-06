<?php

namespace LaravelTool\EloquentExternalEventsServer;

use Illuminate\Database\Eloquent\Model;

class EventService
{
    public function dispatch(string $event, string $modelType, mixed $modelId, array|null $changes, bool $halt)
    {
        /** @var Model $model */
        $model = $modelType::find($modelId);
        if (method_exists($model, 'fireEvent')) {
            return $model->fireEvent($event, $changes, $halt);
        }
        return [];
    }
}