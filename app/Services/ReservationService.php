<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Reservation;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\ExecutableFinder;

use function Laravel\Prompts\select;

class EventDto{
        protected $fillable = [
        'titre',
        'description',
        'date',
        'heure',
        'lieu',
        'prix',
        'jauge_maximale',
        'eventId',
        'user_id'

    ];
}


class ReservationService
{
    /**
     * Create a new class instance.
     */
    public function getEvents(){
  return Event::where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->get();
    }

      public function isReserve(){
 $events = DB::table('events as e')
    ->leftJoin('reservations', 'reservations.event_id', '=', 'e.id')
    ->select(
        'e.*',
        'reservations.user_id as reserveBy',
        'reservations.event_id'
    )
    ->get();

         return    $events   ;
    }
    public function reservation(array $data){
         $user_id = $data['user_id'];
        $event_id =   $data['event_id'];
        $place = Event::findOrFail($event_id);
         $reserv = Reservation::where('event_id', $event_id)
            ->where('user_id',  $user_id)
            ->first();

            if($reserv){
                throw new Exception('Vous avez déjà réservé cet événement. Voici votre ticket !');
            }
            if($place->jauge_maximale<=0){
                throw new Exception('Désolé, cet événement affiche complet. Toutes les places ont déjà été réservées.');
            }
   $reservationCode = 'RES-' . time();

  $reservation = Reservation::create([
              'event_id' => $data['event_id'],
            'user_id' => $user_id,
            'reservation_code' => $reservationCode,
         ]);
             $userReservation = \App\Models\Reservation::where('event_id', $data['event_id'])
                            ->where('user_id', Auth::id())
                            ->first();
        $place->decrement('jauge_maximale');

         return [ 'reservation' => $reservation ,
       'userReservation' => $userReservation  ] ;


    }
    public function tickets()
    {
 $userId = Auth::id();
  return  Reservation::with('event')
            ->where('user_id', $userId)
            ->get();

    }
}
