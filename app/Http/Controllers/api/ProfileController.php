<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;


class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        $authorization = $request->header('Authorization');
        $guru = Guru::where('token', $authorization)->first();

        if (!$authorization || !$guru) {
            return response()->json([
                "success" => false,
                'message' => "Unauthorized",
                'data' => null
            ], 401);
        }

        return response()->json([
            "success" => true,
            'message' => "Berhasil Mendapatkan Profile",
            'data' => $guru
        ], 200);
    }
}
