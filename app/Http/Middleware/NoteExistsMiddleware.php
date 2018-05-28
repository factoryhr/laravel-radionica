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
            $note = \App\Models\Note::findOrFail($request->route('note'));

            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 404,
                'message' => 'Model not found',
            ], 404);
        }
    }
}
