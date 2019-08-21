<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->only('email','password');
        if (Auth::guard('web')->attempt($credentials)) {
            $user=Auth::user();
            $token = Auth::user()->createToken(config('app.name'));
            $token->token->expires_at = $request->remember_me ?
                Carbon::now()->addMonth() :
                Carbon::now()->addDay();
            $token->token->save();

            return response()->json([
                'token' => $token->accessToken,
                'user'=>$user,
                'password'=>$user->password
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Неверные параметры входа',
                'errors' => 'Unauthorised'
            ], 401);
        }
    }
}
