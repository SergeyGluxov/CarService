<?php

namespace App\Repositories;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $reservationStore = new Reservation();
        $reservationStore->status = $request->get('status');
        $reservationStore->detail_id = $request->get('detail_id');
        $reservationStore->user_id = $request->get('user_id');
        $reservationStore->count = $request->get('count');
        $reservationStore->save();
        return response('Бронирование успешно создано', 200);
    }

    public function update(Request $request, $id)
    {
        $channelUpdate = Reservation::find($id);
        if($channelUpdate->status=="received"){
            $channelUpdate->status = "accept";
        }else{
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
