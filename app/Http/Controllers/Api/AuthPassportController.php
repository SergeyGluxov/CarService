<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthPassportController extends Controller
{
    public function __invoke(Request $request)
    {
        $client = new Client(['base_uri' => 'http://api.vagon.net']);
        $response = $client->post('/oauth/token', [
            'form_params' => [
                'grant_type' => $request->get('grant_type'),
                'client_id' => $request->get('client_id'),
                'client_secret' => $request->get('client_secret'),
                'username' => $request->get('username'),
                'password' => $request->get('password'),
                'scope' => $request->get('scope'),
            ],
        ]);

        $response = json_decode($response->getBody());
       /* $request->user()->token()->delete();
        $request->user()->token()->create([
            'access_token' => $response->access_token,
        ]);*/

        return response()->json([
            'token' => $response->access_token,
            'refresh_token' => $response->refresh_token,
            'user' => $request->user()
        ], 200);
    }
}
