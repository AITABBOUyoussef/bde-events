<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventService
{
public function getAllEvents(){
    return Event::orderBy('date','asc')->get();
}
public function addEvents(array $data){
       $event = new Event();
        $event->titre = $data['titre'];
        $event->description = $data['description'];
        $event->date = $data['date'];
        $event->heure = $data['heure'];
        $event->lieu = $data['lieu'];
        $event->prix = $data['prix'];
        $event->jauge_maximale = $data['jauge_maximale'];

        $event->user_id = Auth::id();
        // Event::create($validatedData);
        $event->save();
        return $event ; 

}
}
