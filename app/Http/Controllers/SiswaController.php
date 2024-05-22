<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Contracts\DataTable;

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
        $siswa = Siswa::join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas');
        
        if ($request->filter_kelas != 0) {
            $siswa = $siswa->where('kelas.id_kelas', $request->filter_kelas);
        } 

        return  datatables()->of($siswa)->make(true);
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

    public function laporan(Request $request)
    {
        $siswa = Siswa::join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')->orderBy('kelas.id_kelas')->orderBy('siswa.nama_lengkap');
        
        if ($request->filter_kelas != 0) {
            $siswa = $siswa->where('kelas.id_kelas', $request->filter_kelas);
            $kelas = Kelas::find($request->filter_kelas)->nama_kelas;
        } else {
            $kelas = "Semua Kelas";
        }

        $data = [
            'siswa' => $siswa->get(),
            "kelas" => $kelas,
        ];

        // return response()->json($data);
 
        $pdf = Pdf::loadView('siswa/siswa_laporan', $data);

        return $pdf->stream();
    }

    public function cetak_kartu()
    {
        $id = request()->id;

        $siswa = Siswa::join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')->find($id);
        $data = [
            "qrcode" => QrCode::size(120)->generate($siswa->nisn),
            'siswa' => $siswa
        ];
        
        return view('siswa.siswa_kartu', $data);
    }
}
