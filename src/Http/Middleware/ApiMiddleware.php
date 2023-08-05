<?php

namespace LaravelTool\EloquentExternalEventsServer\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiMiddleware
{
    /**
     * @param  Request  $request
     * @param  Closure  $next
     * @return Response
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->bearerToken() != config('eloquent_external_events_server.token')) {
            throw new AuthenticationException('Unauthenticated.');
        }
        return $next($request);
    }
}