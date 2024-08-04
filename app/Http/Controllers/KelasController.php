<?php

namespace App\Http\Controllers;

use App\Exports\KelasExport;
use App\Models\Guru;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    //

    public function index()
    {
        $data =[
            "kelas" => Kelas::join('guru', 'kelas.guru_id', '=', 'guru.id_guru')->get(),
            "guru" => Guru::select('id_guru', 'nama_lengkap')->get()
        ];
        // return response()->json($data);
        return view('kelas.index', $data);
    }

    // public function show($id)
    // {
    //     $kelas = Kelas::find($id);
    //     return view('kelas.show', compact('kelas'));
    // }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'guru_id' => 'required',
        ]);

        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'guru_id' => 'required',
        ]);

        $kelas = Kelas::find($id);
        $kelas->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diubah');
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus');
    }
    public function export()
	{
		return Excel::download(new KelasExport, 'kelas.xlsx');
	}

    
}
