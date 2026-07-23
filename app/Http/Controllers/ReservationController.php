<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $events = Event::where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->get();

        return view('dashboard_student', compact('events'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $user_id = $request->user()->id;
        $place = Event::findOrFail($request->event_id);

        $reserv = Reservation::where('event_id', $request->event_id)
            ->where('user_id',  $user_id)
            ->first();
        if ($place->jauge_maximale <= 0) {

            return redirect()->route('dashboard')
                ->with('error', 'Désolé, cet événement affiche complet. Toutes les places ont déjà été réservées.');
        }

        if ($reserv) {
            $ticket = $place;
            $Code = $reserv->reservation_code;
            // return view('ticket', compact('ticket', 'Code'));
            return view('dashboard_ticket', compact('ticket', 'Code'));
        }

        $place->jauge_maximale = $place->jauge_maximale - 1;
        $place->save();

        $reservationCode = 'RES-' . time();

        Reservation::create([
            'event_id' => $request->event_id,
            'user_id' => $user_id,
            'reservation_code' => $reservationCode,
        ]);

        return redirect()->route('reservations.store')
            ->with('success', 'Place réservée avec succès ! Votre code est : ' . $reservationCode);
    }

}
