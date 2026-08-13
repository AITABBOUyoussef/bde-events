<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use App\Services\ReservationService;
use Exception;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $ReservationService;

    public function __construct(ReservationService $ReservationService)
    {
        $this->ReservationService = $ReservationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = $this->ReservationService->isReserve();
        
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
        // 1. Zdt lik messages d'erreur b l-Français
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,id',
        ], [
            'event_id.required' => 'L\'événement à réserver est obligatoire.',
            'event_id.exists' => 'Cet événement n\'existe plus ou est invalide.',
        ]);

        // N-zido l-ID dyal l-user li connecté db
        $validatedData['user_id'] = $request->user()->id;

        try {
            // L-Service kay-tklef b l-logique dyal l-réservation (jauge, etc.)
            $reservation = $this->ReservationService->reservation($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Réservation effectuée avec succès!',
                'reservation' => $reservation['reservation'],
                'userReservation' => $reservation['userReservation'],
            ], 201); // 201 Created (7ssn mn 200 mli kancreyiw chi 7aja f database)

        } catch (Exception $e) {
            // 2. 400 Bad Request f blast 401
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400); 
        }
    }

    /**
     * Récupérer les tickets de l'utilisateur connecté
     */
    public function mytickets()
    {
        $tickets = $this->ReservationService->tickets();
        
        return response()->json([
            'success' => true,
            'message' => 'Liste des Tickets récupérée avec succès',
            'data' => $tickets
        ], 200);
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