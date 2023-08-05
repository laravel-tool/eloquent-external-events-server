<?php

return [
    'middleware' => env('ELOQUENT_EXTERNAL_EVENTS_API_MIDDLEWARE', 'web'),
    'endpoint' => env('ELOQUENT_EXTERNAL_EVENTS_API_ENDPOINT', 'api/external-events-server'),
    'token' => env('ELOQUENT_EXTERNAL_EVENTS_API_TOKEN', 'test'),
];