<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    
    public function index()
    {
        $kelas = Kelas::all();
        return view('absensi/index', compact('kelas'));
    }
    
    public function create()
    {
        return view('absensi/create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_kelas' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required',
        ]);
        
        return redirect('absensi')->with('success', 'Data absensi berhasil ditambahkan');
    }
    
    public function show($id)
    {
        return view('absensi/show');
    }
    
    public function edit($id)
    {
        return view('absensi/edit');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_kelas' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required',
        ]);
        
        return redirect('absensi')->with('success', 'Data absensi berhasil diubah');
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
