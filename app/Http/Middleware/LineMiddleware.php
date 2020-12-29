<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class LineMiddleware
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
        $httpRequestBody = json_encode($request->all());
        $channelSecret = env('LINE_BOT_CHANNEL_SECRET');

        $hash = hash_hmac('sha256', $httpRequestBody, $channelSecret, true);
        $signature = base64_encode($hash);

        if ($request->header('x-line-signature') === $signature) {
            return $next($request);
        }

        return response()->json(['message' => 'not allowed'], Response::HTTP_BAD_REQUEST);

    }
}
