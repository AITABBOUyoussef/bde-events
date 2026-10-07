<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthServices
{
public function loginService(array $data){


        $user = User::where('email',$data['email'])->first();
if (!$user) {
            throw new Exception("Aucun compte ne correspond à cette adresse email.");
        }
        if (!Hash::check($data['password'], $user->password)) {
            throw new Exception("Le mot de passe est incorrect.");
        }
        $token = $user->createToken('react-app-token')->plainTextToken ;
        return [
            'user' => $user,
            'token' => $token
        ];
}

}
