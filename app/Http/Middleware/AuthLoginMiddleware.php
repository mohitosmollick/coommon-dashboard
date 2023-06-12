<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class AuthLoginMiddleware
{

    //FOR API
    public function handle(Request $request, Closure $next)
    {
        $header_token = $request->header('Authorization');
        //const{authorization}= req.headers
        $key = '12345678';
        if ($header_token) {

            $decoded = JWT::decode($header_token, new Key($key, 'HS256'));
            $request['UserId'] = $decoded->id;
            $request['UserEmail'] = $decoded->email;
            return $next($request);

        } else {
            return response()->json(['msg' => "Authentication Failure !"]);
        }
    }
}
