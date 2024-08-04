<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\JadwalPiket;
use Illuminate\Http\Request;

class piketController extends Controller
{
    //
    function tanggal_indonesia($hari_inggris)
    {
        $hari_indonesia = array(
            "Sunday" => "minggu",
            "Monday" => "senin",
            "Tuesday" => "selasa",
            "Wednesday" => "rabu",
            "Thursday" => "rabu",
            "Friday" => "rabu",
            "Saturday" => "sabtu"
        );
        return $hari_indonesia[$hari_inggris];
    }

    public function getJadwal(Request $request)
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

        $piket_saya = JadwalPiket::join('guru', 'jadwal_piket.id_guru', '=', 'guru.id_guru')
            ->where('jadwal_piket.id_guru', $guru->id_guru)
            ->select('jadwal_piket.*', 'guru.nama_lengkap', 'guru.nip')
            ->first();

        $jadwal_piket = JadwalPiket::join('guru', 'jadwal_piket.id_guru', '=', 'guru.id_guru')
            ->where('jadwal_piket.hari', $this->tanggal_indonesia(date('l')))
            ->select('jadwal_piket.*', 'guru.nama_lengkap', 'guru.nip')
            ->get();

        return response()->json([
            "success" => true,
            'message' => "Berhasil mendapatkan data",
            'data' => [
                'piket_saya' => $piket_saya,
                'jadwal_piket' => $jadwal_piket
            ]
        ], 200);
    }
}
