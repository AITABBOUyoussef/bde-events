<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Reservation;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationService
{
    public function getEvents()
    {
        return Event::where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->get();
    }

    public function isReserve()
    {
        $userId = Auth::id(); // L-étudiant li connecté

        // HNA L-FIX DYAL L-JOIN: njibo ghir les réservations dyal had l-étudiant
        $events = DB::table('events as e')
            ->leftJoin('reservations', function ($join) use ($userId) {
                $join->on('reservations.event_id', '=', 'e.id')
                     ->where('reservations.user_id', '=', $userId);
            })
            ->select(
                'e.*',
                'reservations.user_id as reserveBy',
                'reservations.event_id'
            )
            ->where('e.date', '>=', now()->toDateString()) // Hta hna n-affichiw ghir les events l-jdad
            ->orderBy('e.date', 'asc')
            ->get();

        return $events;
    }

    public function reservation(array $data)
    {
        $user_id = $data['user_id'];
        $event_id = $data['event_id'];

        // N-st3mlo DB::transaction bach tkon réservation sécurisée
        return DB::transaction(function () use ($user_id, $event_id) {
            
            // lockForUpdate() kat-blocquer l-event hta tsali had l-réservation (kat-mn3 Overbooking)
            $place = Event::lockForUpdate()->findOrFail($event_id);

            // N-véréfiw wach l-étudiant deja m-reservi
            $reserv = Reservation::where('event_id', $event_id)
                ->where('user_id', $user_id)
                ->first();

            if ($reserv) {
                throw new Exception('Vous avez déjà réservé cet événement. Voici votre ticket !');
            }

            // HNA L-FIX DYAL L-JAUGE: Kan-checkiw places_restantes w machi jauge_maximale!
            if ($place->places_restantes <= 0) {
                throw new Exception('Désolé, cet événement affiche complet. Toutes les places ont déjà été réservées.');
            }

            // N-génériw code s3ib yt3awd (zdt lih nombre aléatoire l-te7t)
            $reservationCode = 'RES-' . time() . '-' . rand(100, 999);

            $reservation = Reservation::create([
                'event_id' => $event_id,
                'user_id' => $user_id,
                'reservation_code' => $reservationCode,
            ]);

            // Kan-n9sso l-places_restantes b 1
            $place->decrement('places_restantes');

            // 7iydt lik dik l-requête Zayda li kant katsauvi $userReservation 7it $reservation fiha kolchi
            return [ 
                'reservation' => $reservation,
                'userReservation' => $reservation  
            ];
        });
    }

    public function tickets()
    {
        $userId = Auth::id();
        
        return Reservation::with('event')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc') // Mzyan nrtbouhom mn jdid l 9dim
            ->get();
    }
}