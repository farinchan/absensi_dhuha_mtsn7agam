<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JadwalPiket;
use Illuminate\Http\Request;

class PiketController extends Controller
{
    //

    public function index()
    {
        $data = [
            "guru" => Guru::all(),
            "piket_senin" => JadwalPiket::join('guru', 'guru.id_guru', '=', 'jadwal_piket.id_guru')->where('hari', 'senin')->get(),
            "piket_selasa" => JadwalPiket::join('guru', 'guru.id_guru', '=', 'jadwal_piket.id_guru')->where('hari', 'selasa')->get(),
            "piket_rabu" => JadwalPiket::join('guru', 'guru.id_guru', '=', 'jadwal_piket.id_guru')->where('hari', 'rabu')->get(),
            "piket_kamis" => JadwalPiket::join('guru', 'guru.id_guru', '=', 'jadwal_piket.id_guru')->where('hari', 'kamis')->get(),
            "piket_jumat" => JadwalPiket::join('guru', 'guru.id_guru', '=', 'jadwal_piket.id_guru')->where('hari', 'jumat')->get(),
            "piket_sabtu" => JadwalPiket::join('guru', 'guru.id_guru', '=', 'jadwal_piket.id_guru')->where('hari', 'sabtu')->get(),
        ];
        // return response()->json($data);  
        return view('jadwal_piket.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "id_guru" => "required",
            "hari" => "required",
        ]);

        JadwalPiket::create($request->all());
        return redirect()->route('jadwal_piket.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, JadwalPiket $jadwal_piket)
    {
        $request->validate([
            "id_guru" => "required",
            "hari" => "required",
        ]);

        $jadwal_piket->update($request->all());
        return redirect()->route('jadwal_piket.index')-> with('success', 'Data berhasil diubah');
    }

    public function destroy(JadwalPiket $jadwal_piket)
    {
        $jadwal_piket->delete();
        return redirect()->route('jadwal_piket.index')->with('success', 'Data berhasil dihapus');
    }
    
}
