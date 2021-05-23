<?php

namespace App\Http\Controllers\Api\Reservations;


use App\Http\Controllers\Controller;
use App\Repositories\ReservationRepository;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function index()
    {
        return $this->reservationRepository->all();
    }

    public function show($id)
    {
        return $this->reservationRepository->find($id);
    }

    public function update(Request $request, $id)
    {
        return $this->reservationRepository->update($request, $id);
    }

    public function store(Request $request)
    {
        return $this->reservationRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->reservationRepository->destroy($id);
    }
}
