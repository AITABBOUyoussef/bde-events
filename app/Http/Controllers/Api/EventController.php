<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use Exception;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Mockery\Expectation;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $eventService;
    public function __construct(EventService $eventService){
        $this->eventService=$eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return response()->json([
            'success'=>true,
            'message'=>'Liste des événements récupérée avec succès',
            'data'=>$events
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
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
        try {
            $result=$this->eventService->addEvents($validatedData);
            return response()->json([
                'success' =>true,
                'event' => $result['event']
            ],200);
        }
        catch(Exception $e){
             return response()->json([
            'success'=>false,
            'message'=>$e->getMessage()
        ],401);
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
