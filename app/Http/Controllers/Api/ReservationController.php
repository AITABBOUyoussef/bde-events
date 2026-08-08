<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $ReservationService;
   public function __construct(ReservationService $ReservationService)
    {
$this->ReservationService=$ReservationService;
    }
    public function index()
    {
    $events=$this->ReservationService->getEvents();
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
        //
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
