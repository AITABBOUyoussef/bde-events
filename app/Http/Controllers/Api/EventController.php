<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;
    
    public function __construct(EventService $eventService){
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return response()->json([
            'success' => true,
            'message' => 'Liste des événements récupérée avec succès',
            'data' => $events
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Zdt lik les messages d'erreur personnalisés b l-Français
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required',
            'lieu' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'jauge_maximale' => 'required|integer|min:1',
        ], [
            'titre.required' => 'Le titre de l\'événement est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'date.required' => 'La date est obligatoire.',
            'date.after_or_equal' => 'La date doit être aujourd\'hui ou dans le futur.',
            'heure.required' => 'L\'heure est obligatoire.',
            'lieu.required' => 'Le lieu est obligatoire.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.min' => 'Le prix ne peut pas être négatif.',
            'jauge_maximale.required' => 'La capacité maximale est obligatoire.',
            'jauge_maximale.min' => 'La capacité doit être d\'au moins 1 personne.',
        ]);

        try {
            $result = $this->eventService->addEvents($validatedData);
            
            return response()->json([
                'success' => true,
                'event' => $result['event']
            ], 201); 
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}