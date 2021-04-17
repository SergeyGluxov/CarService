<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirect()
    {
        $query = http_build_query([
            'client_id' => '6',
            'redirect_uri' => 'http://business/home',
            'response_type' => 'token',
            'scope' => '*',
        ]);

        return redirect('/oauth/authorize?' . $query);
    }

    public function callback(Request $request)
    {
        $client = new Client();
        $response = $client->post('/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '6',
                'client_secret' => 'Cd0vHdFnD4ta9oyoSI4EawQIfJMRfxNajrLmf3hm',
                'username' => 'gluxov14@gmail.com',
                'password' => 'Cthutq1122',
                'scope' => '*',
            ],
        ]);
        $response = json_decode($response->getBody());
        $request->user()->token()->delete();
        $request->user()->token()->create([
            'access_token' => $response->access_token,
        ]);

        /*      session()->put('token', json_decode((string) $response->getBody(), true));*/
        return redirect('/home');
    }
}
