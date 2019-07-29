<?php

namespace App\Http\Controllers;

use App;
use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function addCar(Request $request)
    {
        $model = $request->input('model');
        $brand = $request->input('brand');
        $car = Car::where('model', $model)->firstOrFail();
        $users = App\User::find(Auth::user()->id);
        $users->cars_id=$car->id;
        $users->update();
        return redirect('home');
    }
    public function checkup()
    {
        return view('checkup');
    }
    public function repair(Request $request)
    {
        return view('repair');

        $part = htmltitles($_POST['part']);
        $DataPicker = htmltitles($_POST['DataPicker']);
        if ($request->isMethod('post')) {

            // валидация формы
            $request->validate([
                'custom-select'   => 'required',
                'DatePicker' => 'nullable|date',
            ]);

        }
        dd($request->all());

    }

}
