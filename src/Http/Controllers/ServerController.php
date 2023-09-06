<?php

namespace LaravelTool\EloquentExternalEventsServer\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use LaravelTool\EloquentExternalEventsServer\EventService;
use LaravelTool\EloquentExternalEventsServer\Http\Requests\ServerRequest;

class ServerController extends BaseController
{
    public function __invoke(EventService $service, ServerRequest $request)
    {
        $data = $service->dispatch(
            $request->input('event'),
            $request->input('model_type'),
            $request->input('model_id'),
            $request->input('changes'),
            $request->input('halt')
        );

        return response()->json($data);
    }

}