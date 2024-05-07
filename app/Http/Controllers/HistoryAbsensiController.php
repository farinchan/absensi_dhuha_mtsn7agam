<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;


class HistoryAbsensiController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('absensi/history', compact('kelas'));
    }
    
    public function destroy($id)
    {
        return redirect('absensi')->with('success', 'Data absensi berhasil dihapus');
    }

    public function ajax(Request $request)
    {
        $data = [
            'id' => 1,
            'nama' => 'Siswa 1',
            'kelas' => 'XII RPL 1',
            'tanggal' => '2021-09-01',
            'keterangan' => 'Hadir',
        ];
        
        return response()->json($data);
    }
}
