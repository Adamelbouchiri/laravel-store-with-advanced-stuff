<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class adminAndModerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = User::where("id", auth()->user()->id)->first();

        if ($user && $user->hasRole($roles)) {
            
            return $next($request);
        }
        
        
        return redirect("dashboard");
    }
}
