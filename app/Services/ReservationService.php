<?php

namespace App\Services;

use App\Models\Event;

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
}
