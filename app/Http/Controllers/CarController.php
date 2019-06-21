<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function addCar(Request $request)
    {
        $mark = $request->input('mark');//получение выбранной марки
        $model = $request->input('model');//получение выбранной марки
        return redirect('home');
    }
}
