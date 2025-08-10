<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Ensurehaspro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_data = \App\Models\User::find(Auth()->id())->plans()->wherePivot('expire_at', '>', now())->pluck('product_id')->toArray();
        if(!in_array($request->id,$user_data)){
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
