<?php

namespace App\Repositories;

use App\Http\Resources\AvtoModelsCollection;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\ReservationsCollection;
use App\Models\AvtoModel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationRepository
{
    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function all()
    {
        ReservationResource::withoutWrapping();
        return ReservationResource::collection(Reservation::all());
    }


    public function find($id)
    {
        ReservationResource::withoutWrapping();
        return new ReservationResource(Reservation::find($id));
    }

    public function getReservationUser(Request $request)
    {
        if($request->get('isAuth') == true){
            $param = Auth::user()->id;
        }else{
            $param = $request->get('user_id');
        }
        $reservationUser = Reservation::whereHas('user', function ($q) use ($param) {
            $q->where('id', '=', $param);
        }
        )->get();
        ReservationResource::withoutWrapping();
        return ReservationResource::collection($reservationUser);

        /*


        $reservationUser = DB::table('reservations')
            ->join('users', 'users.id', '=', 'reservations.user_id')
            ->where('users.id', '=', $param)
            ->get();

        ReservationsCollection::withoutWrapping();
        return new ReservationsCollection($reservationUser);*/
    }

    public function store(Request $request)
    {
        $reservationStore = new Reservation();
        $reservationStore->status = $request->get('status');
        $reservationStore->details_car_id = $request->get('detail_car_id');

        if($request->get('isAuth') == true){
            $reservationStore->user_id = Auth::user()->id;
        }else{
            $reservationStore->user_id = $request->get('user_id');
        }

        $reservationStore->count = $request->get('count');
        $reservationStore->save();
        return response()->json(['is_success' => true], 200);
    }

    public function update(Request $request, $id)
    {
        $channelUpdate = Reservation::find($id);
        if ($channelUpdate->status == "create") {
            $channelUpdate->status = "accept";
        } else {
            $channelUpdate->status = "received";
        }
        $channelUpdate->save();
        return response('Статус бронирования подтвержден', 200);
    }

    public function destroy($id)
    {
        $reservationDestroy = Reservation::findOrFail($id);
        if ($reservationDestroy->delete())
            return response('Бронирование успешно удалена!', 200);
    }
}
