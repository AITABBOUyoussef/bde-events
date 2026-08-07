<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthServices;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
     protected $loginService;
    public function __construct(AuthServices $loginService){
        $this->loginService=$loginService;
    }
    public function login(Request $request){
$validatedData=$request->validate([
    'email' => 'required|email',
            'password' => 'required',
]);

try{
    $result = $this->loginService->loginService($validatedData);

return response()->json([
            'success' => true,
            'token' => $result['token'],
            'user' => $result['user']
        ], 200);
    }
    catch(Exception $e){
        return response()->json([
            'success'=>false,
            'message'=>$e->getMessage()
        ],401);
    }
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Déconnexion réussie.'
        ], 200);
    }
}
