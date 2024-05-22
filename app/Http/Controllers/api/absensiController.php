<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Absensi_siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class absensiController extends Controller
{
    //
    public function scan(Request $request)
    {
        $data = $request->all();

        $authorization = $request->header('Authorization');
        $guru = Guru::where('token', $authorization)->first();

        if (!$authorization || !$guru) {
            return response()->json([
                "success" => false,
                'message' => "Unauthorized",
                'data' => null
            ], 401);
        }

        $siswa = Siswa::where('nisn', $data['nisn'])->first();

        $absensi = new Absensi_siswa();
        if ($absensi->where('id_siswa_absensi', $siswa->id_siswa)->where('tanggal', date('Y-m-d'))->first()) {
            return response()->json([
                "success" => false,
                'message' => "Siswa Sudah Absen Hari Ini",
                'data' => [
                    'message' => "Siswa Sudah Absen Hari Ini",
                ]
            ], 401);
        } else {
            $absensi->id_siswa_absensi  = $siswa->id_siswa;
            $absensi->guru_id = $guru->id_guru;
            $absensi->kehadiran = "hadir";
            $absensi->tanggal = date('Y-m-d');
            $absensi->jam_hadir = date('H:i:s');
            $absensi->save();

            return response()->json([
                "success" => true,
                'message' => "Berhasil Melakukan Scan",
                'data' =>$absensi->join('siswa', 'absensi_siswa.id_siswa_absensi', '=', 'siswa.id_siswa')
                    ->join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')
                    ->select('siswa.nisn', 'siswa.nama_lengkap', 'kelas.nama_kelas', 'absensi_siswa.*')
                    ->first()
            ], 200);
        }
    }

    public function historyAbsensi(Request $request)
    {
        $data = $request->all();

        $authorization = $request->header('Authorization');
        $guru = Guru::where('token', $authorization)->first();

        if (!$authorization || !$guru) {
            return response()->json([
                "success" => false,
                'message' => "Unauthorized",
                'data' => null
            ], 401);
        }

        $absensi = Absensi_siswa::where('guru_id', $guru->id_guru)
            ->where('tanggal', date('Y-m-d'))
            ->join('siswa', 'absensi_siswa.id_siswa_absensi', '=', 'siswa.id_siswa')
            ->join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')
            ->select('siswa.nisn', 'siswa.nama_lengkap', 'kelas.nama_kelas', 'absensi_siswa.*')
            ->get();

        return response()->json([
            "success" => true,
            'message' => "Data Absensi",
            'data' => $absensi
        ], 200);
    }

    public function checkSiswa(Request $request)
    {
        $authorization = $request->header('Authorization');
        $guru = Guru::where('token', $authorization)->first();

        if (!$authorization || !$guru) {
            return response()->json([
                "success" => false,
                'message' => "Unauthorized",
                'data' => null
            ], 401);
        }

        if ($request->filter_kelas) {

            // $siswa = Siswa::join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')->where('kelas.id_kelas', $request->filter_kelas);

            // Ambil semua data siswa beserta status absen atau belum absen pada hari ini
            $siswa = Siswa::leftJoin('absensi_siswa', 'siswa.id_siswa', '=', 'absensi_siswa.id_siswa_absensi')
                ->where('id_kelas_siswa', $request->filter_kelas)
                ->join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')
                ->select('siswa.nisn', 'siswa.nama_lengkap', 'kelas.nama_kelas', 'absensi_siswa.*')
                ->get();

            // Tanggal hari ini
            $today = Carbon::now()->toDateString();

            return response()->json([
                "success" => true,
                'message' => "Data Siswa",
                'total_data' => $siswa->count(),
                'data' => $siswa
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                'message' => "Kelas Tidak Ditemukan",
                'data' => null
            ], 404);
        }
    }

    public function listKelas()
    {

        $kelas = Kelas::all();

        return response()->json([
            "success" => true,
            'message' => "Berhasil Mendapatkan Data Kelas",
            'data' => $kelas
        ], 200);
    }
}
