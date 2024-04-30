<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaController extends Controller
{
    //

    public function index(Request $request)
    {
        // dd($request->kelas);

        $data = [
            'kelas' => Kelas::all()
        ];

        return view('siswa.index', $data);
    }

    public function ajax(Request $request)
    {
        $data = [];
        if ($request->filter_kelas != 0) {
            $siswa = Siswa::join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')->where('kelas.id_kelas', $request->filter_kelas);
            $data["recordsTotal"] = $siswa->count();
            $data["recordsFiltered"] = $siswa->count();
            $data['data'] = $siswa->get();
        } else {
            $siswa = Siswa::join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas');
            $data["recordsTotal"] = $siswa->count();
            $data["recordsFiltered"] = $siswa->count();
            $data['data'] = $siswa->get();
        }
        return response()->json($data);
    }


    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->merge(['id_kelas_siswa' => (int)$request->id_kelas_siswa]);
        $valid = $request->validate([
            'nisn' => 'required',
            'nama_lengkap' => 'required',
            'id_kelas_siswa' => 'required',
            'alamat' => 'required',
        ]);
        // dd([$request->all(), $valid]);

        Siswa::create($request->all());
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'siswa' => Siswa::find($id),
            'kelas' => Kelas::all()
        ];
        // dd($data);
        return view('siswa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nisn' => 'required',
            'nama_lengkap' => 'required',
            'id_kelas_siswa' => 'required',
            'alamat' => 'required',
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
