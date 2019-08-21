<?php

namespace App\Http\Controllers\Api\Auth;

namespace App\Http\Controllers\Api\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->user()->token()->delete();
        return response()->json([
            'user'=>$request->user(),
            'token'=>$request->user()->token,
            'message' => 'Вы покинули сайт',
        ]);
    }
}
