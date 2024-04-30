<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    //

    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    public function show($id)
    {
        $kelas = Kelas::find($id);
        return view('kelas.show', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'wali_kelas' => 'required',
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
            'wali_kelas' => 'required',
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

    
}
