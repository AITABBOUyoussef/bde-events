<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
    public function store(Request $request){
          $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);
$reservationCode = 'RES-' . time();
        $user_id = $request->user()->id;
            Reservation::create([
            'event_id' => $request->event_id,
            'user_id' => $user_id,
            'reservation_code' => $reservationCode,
        ]);

        return redirect()->route('dashboard_student')
            ->with('success', 'Place réservée avec succès ! Votre code est : ' . $reservationCode);
    }
}
