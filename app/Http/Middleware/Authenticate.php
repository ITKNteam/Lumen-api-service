<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class Authenticate {
    const API_KEY_HEADER = 'authorization';
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null) {
        $token = $request->header(self::API_KEY_HEADER);

        if (empty($token)) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
