<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
    public function store(Request $request){
          $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);
         $user_id = $request->user()->id;
        $reserv = Reservation::where('event_id', $request->event_id)
        ->where('user_id',  $user_id)
        ->first();
        if($reserv){
                $place = Event::findOrFail($request->event_id);
                $place->jauge_maximale = $place->jauge_maximale -1 ;
                $place->save();
                // dd($place);



        }

            $reservationCode = 'RES-' . time();
            Reservation::create([
            'event_id' => $request->event_id,
            'user_id' => $user_id,
            'reservation_code' => $reservationCode,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Place réservée avec succès ! Votre code est : ' . $reservationCode);
    }

    public function ticket(){
         $ticket = Event::orderBy('date', 'asc')->get();

            return view('ticket', compact('ticket'));
    }
}
