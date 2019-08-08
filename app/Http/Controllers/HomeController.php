<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Car;
use App;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public function __construct()
    {        $this->middleware('auth');
    }

    public function index()
    {
        $users = App\User::find(Auth::user()->id);
        $cars = $users->cars;
        $allcars = Car::all();
        return view('home', compact('cars', 'allcars'));
    }

//    public function s(Request $request)
//    {
//        $client = new Client();
//        if ($request->user()->token) {
//            $response = $client->get('http://carservice.com/api/user', [
//                'headers' => [
//                    'Accept' => 'application/json',
//                    'Authorization' => 'Bearer ' . $request->user()->token->access_token
//                ]
//            ]);
//            return json_decode($response->getBody(), true);
//        }
//        else
//            return response()->json([
//                'errors' => 'Unauthorised'
//            ], 401);
//    }
}
