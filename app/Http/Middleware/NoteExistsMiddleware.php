<?php

namespace App\Http\Middleware;

use Closure;

class NoteExistsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $note = $this->note->findOrFail($id);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json('Model not found', 404);
        }
    }
}
