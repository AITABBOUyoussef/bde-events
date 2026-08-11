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

        $token = $user->createToken('react-app-token')->plainTextToken ;
        return [
            'user' => $user,
            'token' => $token
        ];
}

}
