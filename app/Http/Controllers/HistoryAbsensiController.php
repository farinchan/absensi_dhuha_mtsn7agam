<?php

namespace App\Http\Controllers;

use App\Models\Absensi_siswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;

class HistoryAbsensiController extends Controller
{
    public function index()
    {
        $data = [
            'siswa' => Siswa::all(),
            'kelas' => Kelas::all()
        ];
        return view('absensi/history', $data);
    }

    public function destroy($id)
    {
        return redirect('absensi')->with('success', 'Data absensi berhasil dihapus');
    }

    public function ajax(Request $request)
    {
        $siswa = Absensi_siswa::join('siswa', 'absensi_siswa.id_siswa_absensi', '=', 'siswa.id_siswa')
            ->join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')
            ->select('siswa.nisn', 'siswa.nama_lengkap', 'kelas.nama_kelas', 'absensi_siswa.*') ;   


        // dd($siswa);

        if ($request->filter_kelas != 0) {
            $siswa = $siswa->where('kelas.id_kelas', $request->filter_kelas);
        }

        if ($request->filter_nama != 0) {
            $siswa = $siswa->where('siswa.id_siswa', $request->filter_nama);
        }

        if ($request->filter_tanggal_dari) {
            $siswa = $siswa->where('absensi_siswa.tanggal', '>=', $request->filter_tanggal_dari);
        }

        if ($request->filter_tanggal_sampai) {
            $siswa = $siswa->where('absensi_siswa.tanggal', '<=', $request->filter_tanggal_sampai);
        }

        if ($request->filter_kehadiran != 0) {
            $siswa = $siswa->where('absensi_siswa.kehadiran', $request->filter_kehadiran);
        }


        return  datatables()->of($siswa)->make(true);
    }
    public function siswabyKelas(Request $request) {
        $siswa = Siswa::where('id_kelas_siswa', $request->id_kelas)->get();
        return response()->json($siswa);
    }
}
