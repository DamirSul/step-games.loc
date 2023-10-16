<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $login = $request->get('login');
        if (!$login){
            return "Login is required";
        }
        $password = $request->get('password');
        if (!$password){
            return "Password is required";
        }
        if(strlen($password) < 8){
            return "Password is weak, minimum 8 chars";
        }
        if(User::where('login', $login)->exists()){//user already reg
            return "Login is already exists";
        }
        return User::create([
            'password' => Hash::make($password),
            'login' => $login
           // 'email' => 'test@mail.ru'
        ]);
    }
}
