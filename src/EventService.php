<?php

namespace LaravelTool\EloquentExternalEventsServer;

use Illuminate\Database\Eloquent\Model;

class EventService
{
    public function dispatch(
        string $event,
        string $modelType,
        mixed $modelId,
        array|null $attributes,
        array|null $originals,
        array|null $changes,
        bool $halt
    ) {
        if (is_null($modelId)) {
            $model = new $modelType;
        } else {
            $model = $modelType::find($modelId);
        }
        /** @var Model $model */
        if (method_exists($model, 'fireEvent')) {
            return $model->fireEvent($event, $attributes, $originals, $changes, $halt);
        }
        return [];
    }
}