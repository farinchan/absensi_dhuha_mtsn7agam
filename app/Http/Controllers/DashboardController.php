<?php

namespace App\Http\Controllers;

use App\Models\Absensi_siswa;
use App\Models\Guru;
use App\Models\JadwalPiket;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */

    function tanggal_indonesia($hari_inggris)
    {
        $hari_indonesia = array(
            "Sunday" => "minggu",
            "Monday" => "senin",
            "Tuesday" => "selasa",
            "Wednesday" => "rabu",
            "Thursday" => "rabu",
            "Friday" => "rabu",
            "Saturday" => "sabtu"
        );
        return $hari_indonesia[$hari_inggris];
    }
    public function __invoke(Request $request)
    {

        $data = [
            'title' => 'Dashboard',
            "total_siswa" => Siswa::count(),
            "total_guru" => Guru::count(),
            "total_kelas" => Kelas::count(),
            "total_absensi_hadir" => Absensi_siswa::where('kehadiran', 'hadir')->count(),
            "total_absensi_haid" => Absensi_siswa::where('kehadiran', 'haid')->count(),
            "total_absensi_terlambat" =>  Absensi_siswa::where('kehadiran', 'terlambat')->count(),
            "absensi_terbaru" => Absensi_siswa::join('siswa', 'absensi_siswa.id_siswa_absensi', '=', 'siswa.id_siswa')
                ->join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')
                ->select('absensi_siswa.*', 'siswa.nama_lengkap', 'siswa.nisn', 'kelas.nama_kelas')
                ->orderBy('tanggal', 'desc')->orderby('jam_hadir', 'desc')->limit(6)->get(),
            "jadwal_piket" => JadwalPiket::join('guru', 'jadwal_piket.id_guru', '=', 'guru.id_guru')
                ->where('jadwal_piket.hari', $this->tanggal_indonesia(date('l')))
                ->select('jadwal_piket.*', 'guru.nama_lengkap', 'guru.nama_lengkap', 'guru.nip')->get()
        ];
        // return response()->json($data);
        return view('dashboard', $data);
    }
    public function siswaPerKelas()
    {
        $data = Kelas::join("siswa", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
            ->selectRaw("kelas.nama_kelas, count(siswa.id_kelas_siswa) as total_siswa")
            ->groupBy('kelas.id_kelas', 'kelas.nama_kelas')
            ->get();

        return response()->json($data);
    }

    public function statAbsenHariIni()
    {
        $kelas = Kelas::all();
        $siswaFilter = [];

        $haid = 0;
        $hadir = 0;
        $terlambat = 0;
        $tidak_hadir = 0;
        foreach ($kelas as $k) {
            $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                ->where('kelas.id_kelas', $k->id_kelas)
                ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas')
                ->get();

            $absensi_siswa = Absensi_siswa::where('tanggal', now()->format('Y-m-d'))->get();


            foreach ($siswa as $s) {
                if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()) {
                    if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->kehadiran == 'hadir') {
                        $hadir++;
                    } elseif ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->kehadiran == 'haid') {
                        $haid++;
                    } elseif ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->kehadiran == 'terlambat') {
                        $terlambat++;
                    }
                } else {
                    $tidak_hadir++;
                }
            }
        }

        $siswaFilter = [
            "total_siswa" => Siswa::count(),
            'tanggal' => now()->format('d-m-Y'),
            'hadir' => $hadir,
            'haid' => $haid,
            'terlambat' => $terlambat,
            'tidak_hadir' => $tidak_hadir
        ];

        return response()->json($siswaFilter);
    }

    public function statAbsenSebulanTerakhir()
    {
        $kelas = Kelas::all();
        $siswaFilter = [];

        $endDate = now()->format('Y-m-d');
        $startDate = Carbon::parse($endDate)->subMonth()->format('Y-m-d');

        // dd($startDate, $endDate);

        $currentDate = Carbon::parse($startDate);

        while ($currentDate->lte($endDate)) {
            $haid = 0;
            $hadir = 0;
            $terlambat = 0;
            $tidak_hadir = 0;
            foreach ($kelas as $k) {
                $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                    ->where('kelas.id_kelas', $k->id_kelas)
                    ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas')
                    ->get();

                $absensi_siswa = Absensi_siswa::where('tanggal', $currentDate->format('Y-m-d'))->get();


                foreach ($siswa as $s) {
                    if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()) {
                        if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->kehadiran == 'hadir') {
                            $hadir++;
                        } elseif ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->kehadiran == 'haid') {
                            $haid++;
                        } elseif ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->kehadiran == 'terlambat') {
                            $terlambat++;
                        }
                    } else {
                        $tidak_hadir++;
                    }
                }
            }

            $siswaFilter[] = [
                "total_siswa" => Siswa::count(),
                'tanggal' => $currentDate->format('d-m-Y'),
                'hadir' => $hadir,
                'haid' => $haid,
                'terlambat' => $terlambat,
                'tidak_hadir' => $tidak_hadir
            ];

            $currentDate->addDay(); // Increment the date by one day
        }




        return response()->json($siswaFilter);
    }
}
