<?php

namespace App\Http\Controllers;

use App\Models\Guru as ModelsGuru;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GuruExport;
use App\Imports\GuruImport;

class GuruController extends Controller
{
    
    public function index() {
        $guru = ModelsGuru::all();
        return view('guru.index', [
            'guru' => $guru,
            'page_meta' => [
                'title' => 'Data Guru',
                'desc' => 'Data Guru'
            ]
        ]);
    }

    public function show($id) {
        $guru = ModelsGuru::find($id);
        return view('guru.show', [
            'guru' => $guru,
            'page_meta' => [
                'title' => 'Detail Guru',
                'desc' => 'Detail Guru'
            ]
        ]);
    }

    public function create() {
        return view('guru.create', [
            'page_meta' => [
                'title' => 'Tambah Guru',
                'desc' => 'Tambah Guru'
            ]
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'nip' => '',
            'nama_lengkap' => 'required',
            'mapel' => 'required',
            'no_hp' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $request['password'] = bcrypt($request['password']);
        $request['token'] = Str::random($length = 50);

        ModelsGuru::create($request->all());
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit($id) {
        $guru = ModelsGuru::find($id);
        return view('guru.edit', [
            'guru' => $guru,
            'page_meta' => [
                'title' => 'Edit Guru',
                'desc' => 'Edit Guru'
            ]
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nip' => 'required',
            'nama_lengkap' => 'required',
            'mapel' => 'required',
            'no_hp' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        ModelsGuru::find($id)->update($request->all());
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diubah');
    }

    public function destroy($id) {
        ModelsGuru::find($id)->delete();
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus');
    }

    
    public function laporan(Request $request)
    {

        $data = [
            "guru" => ModelsGuru::all(),
        ];

        // return response()->json($data);
 
        $pdf = Pdf::loadView('guru/guru_laporan', $data);

        return $pdf->stream();
    }

    public function export()
	{
		return Excel::download(new GuruExport, 'guru.xlsx');
	}

    function import(Request $request) {
        // validasi
		
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

		Excel::import(new GuruImport, $request->file('file'));
                 
        return back()->with('success', 'Data guru berhasil diimport');
        
    }

}
