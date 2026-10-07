<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Exception; // Khassna n-importiw Exception

class EventService
{
    public function getAllEvents()
    {
        // N-retouriw les événements m-rtbin b date
        return Event::orderBy('date', 'asc')->get();
    }

    public function addEvents(array $data)
    {
        try {
           $userId = Auth::id();
            if (!$userId) {
                throw new Exception("Vous devez être connecté pour créer un événement.");
            }

            $event = new Event();
            $event->titre = $data['titre'];
            $event->description = $data['description'];
            $event->date = $data['date'];
            $event->heure = $data['heure'];
            $event->lieu = $data['lieu'];
            $event->prix = $data['prix'];
            $event->jauge_maximale = $data['jauge_maximale'];
            
            $event->places_restantes = $data['jauge_maximale'];
            
            $event->user_id = $userId;
            
            $event->save();

           return [
                'event' => $event
            ];

        } catch (Exception $e) {
             throw new Exception("Erreur lors de la création de l'événement : " . $e->getMessage());
        }
    }
}