<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Reservation;
use Exception;
use Symfony\Component\Process\ExecutableFinder;

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
        $place->decrement('jauge_maximale');
         return $reservation ;


    }
}
