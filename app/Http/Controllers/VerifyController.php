<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function index()
    {
        return view('verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $ip = $_SERVER['REMOTE_ADDR'];

        $ch = curl_init();
        $args = http_build_query([
            "secret" => env('SMARTCAPTCHA_SERVER_KEY'),
            "token" => $request->token,
            "ip" => $ip,
        ]);
        curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);

        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode !== 200) {
            $user = Bot::query()->where('ip', $ip)->first();
            $user->delete();
            return ['result' => true];
        }

        $resp = json_decode($server_output);
        if($resp->status === "ok") {
            $user = Bot::query()->where('ip', $ip)->first();
            $user->delete();
        }
        return ['result' => $resp->status === "ok"];
    }
}
