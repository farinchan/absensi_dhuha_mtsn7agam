<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    //

    public function index()
    {
        
        return view('siswa.index');
    }

    public function ajax(Request $request) {
        $kelas = $request->query('kelas');
        if ($kelas) {
            $siswa = Siswa::join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')->where('kelas.id_kelas', $kelas)->get();
            return response()->json($siswa);
        }else{
            $siswa = Siswa::join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')->get();
            return response()->json($siswa);
        }
        $siswa = Siswa::join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')->get();
    }


    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama_lengkap' => 'required',
            'kelas' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        Siswa::create($request->all());
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'nama_lengkap' => 'required',
            'kelas' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $siswa = Siswa::find($id);
        $siswa->update($request->all());
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diubah');
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
