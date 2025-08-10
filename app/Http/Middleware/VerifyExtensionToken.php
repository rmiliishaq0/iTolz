<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VerifyExtensionToken
{
    public function handle(Request $request, Closure $next)
    {

        $forbiddenUserAgents = [
        'Postman', 'Insomnia', 'cURL', 'HttpClient', 'python-requests', 'Go-http-client'
    ];
        $token = $request->header('X-Auth-Token');
        $extensionId = $request->header('X-Ex-Id');
        $userAgent = $request->header('User-Agent');

        if(!$token || !$extensionId){
            return response()->json([['error' => 'Unauthorized'], 401]);
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
