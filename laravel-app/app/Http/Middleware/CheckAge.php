<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     * @param age: custom param customer age, not required
     */
    public function handle(Request $request, Closure $next, int $age = 18): Response
    {
        if ($request->query('age', 36) < $age) {
            abort(403, 'Too young to check this page');
        }
        return $next($request);
    }
}
