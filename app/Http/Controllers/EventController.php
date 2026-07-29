<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'asc')->get();


        return view('dashboard_Admin', compact('events'));
    }
    public function create()
    {

        return view('create_event');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required',
            'lieu' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'jauge_maximale' => 'required|integer|min:1',
        ]);

        $event = new Event();
        $event->titre = $validatedData['titre'];
        $event->description = $validatedData['description'];
        $event->date = $validatedData['date'];
        $event->heure = $validatedData['heure'];
        $event->lieu = $validatedData['lieu'];
        $event->prix = $validatedData['prix'];
        $event->jauge_maximale = $validatedData['jauge_maximale'];

        $event->user_id = Auth::id();
        // Event::create($validatedData);
        $event->save();

        return redirect()->route('events.index')->with('success', 'L\'événement a été publié avec succès, M. l\'Administrateur !');
    }


}
