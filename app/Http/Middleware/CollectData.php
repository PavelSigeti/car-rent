<?php

namespace App\Http\Middleware;

use App\Models\Bot;
use App\Models\UserData;
use Closure;
use Illuminate\Http\Request;

class CollectData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $data = $request->server();
        $bot = Bot::query()->where('ip', $_SERVER['REMOTE_ADDR'])->exists();

        if($bot) {
            return redirect()->route('verify');
        }

        $cookie = $request->cookie('laravel_session');

        UserData::query()->create(
            [
                'HTTP_X_REAL_IP' => isset($data['REMOTE_ADDR']) ? $data['REMOTE_ADDR'] : null,
                'HTTP_USER_AGENT' => isset($data['HTTP_USER_AGENT']) ? $data['HTTP_USER_AGENT'] : null,
                'HTTP_ACCEPT_LANGUAGE' => isset($data['HTTP_ACCEPT_LANGUAGE']) ? $data['HTTP_ACCEPT_LANGUAGE'] : null,
                'HTTP_COOKIE' => $cookie,
                'REQUEST_TIME' => isset($data['REQUEST_TIME']) ? $data['REQUEST_TIME'] : null,
                'REQUEST_METHOD' => isset($data['REQUEST_METHOD']) ? $data['REQUEST_METHOD'] : null,
                'REQUEST_URI' => isset($data['REQUEST_URI']) ? $data['REQUEST_URI'] : null,
            ]
        );


        return $next($request);
    }
}
