<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyExtentionPro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $forbiddenUserAgents = [
            'Postman', 'Insomnia', 'cURL', 'HttpClient', 'python-requests', 'Go-http-client'
        ];
        $token = $request->header('X-Auth-Token');
        $extensionId = $request->header('X-Ex-Id');
        $userAgent = $request->header('User-Agent');
        $user_id = $request->header("Auth");

        if(!$user_id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = \App\Models\User::find($user_id);

        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user_data = $user->plans()->wherePivot('expire_at', '>', now())->pluck('product_id')->toArray();

        if(!in_array($request->id,$user_data)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        foreach ($forbiddenUserAgents as $forbidden) {
            if (stripos($userAgent, $forbidden) !== false) {
                Log::warning("Blocked Forbidden User-Agent: $userAgent", ['ip' => $request->getClientIp()]);
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }


        if (!$token || !$extensionId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $isValid = DB::table('extensions')
            ->where('extension_id', $extensionId)
            ->where('token', $token)
            ->exists();

        if (!$isValid) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
