<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Guru;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $user = Guru::where('username', $request->username)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "success" => false,
                'message' => "Email atau Password Salah",
                'data' => null
            ], 400);
        }
    
    
        return response()->json([
            "success" => true,
            'message' => "Berhasil Login",
            'data' => $user
        ], 200);
    }
}
