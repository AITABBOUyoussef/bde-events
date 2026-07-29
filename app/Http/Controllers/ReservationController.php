<?php

namespace App\Http\Controllers;

use App\Services\UserService;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class ReservationController extends Controller
{
    public function index( UserService $userService)
    {
        // $events = Event::where('date', '>=', now()->toDateString())
        //     ->orderBy('date', 'asc')
        //     ->get();

        $events = $userService->getuser();
dd($events);
        // return view('dashboard_student', compact('events'));
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

            return redirect()->route('my.tickets')->with('error', 'Vous avez déjà réservé cet événement. Voici votre ticket !');
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
    public function myTickets()
    {
        $userId = Auth::id();

        $reservations = Reservation::with('event')
            ->where('user_id', $userId)
            ->get();

        return view('dashboard_ticket', compact('reservations'));
    }

    
}
