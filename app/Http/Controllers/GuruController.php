<?php

namespace App\Http\Controllers;

use App\Models\Guru as ModelsGuru;
use Illuminate\Http\Request;

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
            'nip' => 'required',
            'nama_lengkap' => 'required',
            'mapel' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

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
            'email' => 'required',
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

    


}