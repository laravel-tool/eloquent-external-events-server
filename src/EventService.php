<?php

namespace LaravelTool\EloquentExternalEventsServer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        if (is_null($modelId) || in_array($event, ['deleted', 'forceDeleted'])) {
            $model = new $modelType;
        } else {
            // Проверка на использование SoftDeletes (эквивалент "наличия withTrashed")
            $usesSoftDeletes = in_array(SoftDeletes::class, class_uses_recursive($modelType), true);
            $query = $modelType::query();
            if ($usesSoftDeletes) {
                $query->withTrashed();
            }
            $model = $query->find($modelId);
        }
        /** @var Model $model */
        if ($model && method_exists($model, 'fireEvent')) {
            return $model->fireEvent($event, $attributes, $originals, $changes, $halt);
        }
        return [];
    }
}