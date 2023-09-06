<?php

namespace LaravelTool\EloquentExternalEventsServer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event' => 'required',
            'model_type' => 'required|string',
            'model_id' => 'nullable',
            'changes' => 'array|nullable',
            'halt' => 'required|bool',
        ];
    }
}