<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{

    public function index()
    {
        $kelas = Kelas::all();
        return view('absensi/index', compact('kelas'));
    }

    public function ajax(Request $request)
    {
        // Ambil semua data siswa beserta status absen atau belum absen pada hari ini
        $siswa = Siswa::leftJoin('absensi_siswa', 'siswa.id_siswa', '=', 'absensi_siswa.id_siswa_absensi')
            ->leftJoin('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')
            ->select('siswa.nisn', 'siswa.nama_lengkap', 'kelas.nama_kelas', 'absensi_siswa.*');

        if ($request->filter_kelas != 0) {
            $siswa->where('kelas.id_kelas', $request->filter_kelas);
        }

        if ($request->filter_tanggal) {
            $siswa->where('tanggal', $request->filter_tanggal);
        }
        // $siswa = $siswa->where('absensi_siswa.tanggal', '2024-5-23');

        if ($request->filter_kehadiran != 0) {
            $siswa->where('absensi_siswa.kehadiran', $request->filter_kehadiran);
        }

        return  datatables()->of($siswa)->make(true);
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

    public function laporan(Request $request)
    {


        // Ambil semua data siswa beserta status absen atau belum absen pada hari ini
        $siswa = Siswa::leftJoin('absensi_siswa', 'siswa.id_siswa', '=', 'absensi_siswa.id_siswa_absensi')
            ->leftJoin('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')
            ->select('siswa.nisn', 'siswa.nama_lengkap', 'kelas.nama_kelas', 'absensi_siswa.*');

        if ($request->filter_kelas != 0) {
            $siswa->where('kelas.id_kelas', $request->filter_kelas);
        }

        if ($request->filter_tanggal) {
            $siswa->where('tanggal', $request->filter_tanggal);
        }

        if ($request->filter_kehadiran != 0) {
            $siswa->where('absensi_siswa.kehadiran', $request->filter_kehadiran);
        }
        
        $data = [
            "siswa" => $siswa->get(),
            "kelas" => Kelas::find($request->filter_kelas)->nama_kelas,
            "tanggal" => $request->filter_tanggal,
            "kehadiran" => $request->filter_kehadiran,
        ];


        // return response()->json($data);
        // return view('absensi/absensi_laporan', $data);


        $pdf = Pdf::loadView('absensi/absensi_laporan', $data);

        return $pdf->stream();
    }
}
