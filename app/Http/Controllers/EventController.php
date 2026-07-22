<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Darouri tzid hadi bach Laravel y3ref l-Model Event
use Illuminate\Support\Facades\Auth; // Darouri tzid hadi bach njibou l-ID dyal l-Admin

class EventController extends Controller
{
    public function create()
    {
        // Mola7ada: Ila knti 7etti l-fichier f admin/events/create.blade.php kima glt lik
        // khassk t-ktebha bhal haka:
        return view('admin.events.create');

        // Ila knti 7ettih m3a l-views nishan, kheliha return view('create_event');
    }

    public function store(Request $request)
    {
        // 1. La Validation (L-M39oul li mtloub f l-brief)
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today', // after_or_equal:today kat-mn3 l-admin y-creer event f l-madi
            'heure' => 'required',
            'lieu' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0', // L-prix y9dr ykon 0 (Gratuit) walakin machi saleb (-1)
            'jauge_maximale' => 'required|integer|min:1', // Hada howa l-chert l-kbir dyal l-brief (kber 9at3an mn 0)
        ]);

        // 2. Création dyal l-Événement f l-base de données
        $event = new Event();
        $event->titre = $validatedData['titre'];
        $event->description = $validatedData['description'];
        $event->date = $validatedData['date'];
        $event->heure = $validatedData['heure'];
        $event->lieu = $validatedData['lieu'];
        $event->prix = $validatedData['prix'];
        $event->jauge_maximale = $validatedData['jauge_maximale'];

        // 3. Kan-rbtou had l-événement b l-Admin li saybo (b dik l-colonne li zedti b l-commande)
        $event->user_id = Auth::id();

        // 4. Kan-saviw kolchi
        $event->save();

        // 5. Kan-lo7ou l-Admin l-Dashboard dyalo m3a message dyal naja7
        return redirect()->route('dashboard_Admin')->with('success', 'L\'événement a été publié avec succès, M. l\'Administrateur !');
    }
}
