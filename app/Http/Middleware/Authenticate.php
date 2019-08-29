<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            
            // quando o token de autenticação da API for inválido!
            $path = $request->path();
            if(Str::startsWith($path, 'api/')) {
                abort(401, 'Invalid token!');
            }

            return route('login');
        }
    }
}
