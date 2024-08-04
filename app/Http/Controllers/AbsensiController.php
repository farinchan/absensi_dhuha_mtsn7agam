<?php

namespace App\Http\Controllers;

use App\Models\Absensi_siswa;
use App\Models\Kelas;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{

    public function index()
    {
        $data = [
            "kelas" => Kelas::all(),
            "siswa" => Siswa::all(),
        ];
        return view('absensi/index', $data);
    }

    public function ajax(Request $request)
    {
        $siswaFilter = [];

        if ($request->filter_tanggal_dari == $request->filter_tanggal_sampai) {
            if ($request->filter_kehadiran == 0) {
                $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                    ->where('kelas.id_kelas', $request->filter_kelas)
                    ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas');

                if ($request->filter_nama != 0) {
                    $siswa->where('siswa.id_siswa', $request->filter_nama);
                }


                $absensi_siswa = Absensi_siswa::where('tanggal', $request->filter_tanggal_dari)->get();

                foreach ($siswa->get()  as $s) {
                    if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()) {
                        $siswaFilter[] = $s;
                        $siswaFilter[count($siswaFilter) - 1]->tanggal = $request->filter_tanggal_dari;
                        $siswaFilter[count($siswaFilter) - 1]->kehadiran = $absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->kehadiran;
                        $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = $absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->jam_hadir;
                    } else {
                        $siswaFilter[] = $s;
                        $siswaFilter[count($siswaFilter) - 1]->tanggal = $request->filter_tanggal_dari;
                        $siswaFilter[count($siswaFilter) - 1]->kehadiran = null;
                        $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = null;
                    }
                }
            } elseif ($request->filter_kehadiran == "tidak hadir") {
                $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                    ->where('kelas.id_kelas', $request->filter_kelas)
                    ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas');

                if ($request->filter_nama != 0) {
                    $siswa->where('siswa.id_siswa', $request->filter_nama);
                }

                $absensi_siswa = Absensi_siswa::where('tanggal', $request->filter_tanggal_dari)->get();

                foreach ($siswa->get()  as $s) {
                    if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()) {
                    } else {
                        $siswaFilter[] = $s;
                        $siswaFilter[count($siswaFilter) - 1]->tanggal = $request->filter_tanggal_dari;
                        $siswaFilter[count($siswaFilter) - 1]->kehadiran = null;
                        $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = null;
                    }
                }
            } else {
                $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                    ->where('kelas.id_kelas', $request->filter_kelas)
                    ->join('absensi_siswa', 'siswa.id_siswa', '=', 'absensi_siswa.id_siswa_absensi')
                    ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas', 'absensi_siswa.tanggal',  'absensi_siswa.kehadiran', 'absensi_siswa.jam_hadir as waktu_absensi')
                    ->where('absensi_siswa.tanggal', $request->filter_tanggal_dari)
                    ->where('absensi_siswa.kehadiran', $request->filter_kehadiran);

                // dd($siswa->get());

                if ($request->filter_nama != 0) {
                    $siswa->where('siswa.id_siswa', $request->filter_nama);
                }
                // return response()->json($siswa->get());

                $siswaFilter = $siswa->get();
            }
        } else {

            $startDate = $request->filter_tanggal_dari;
            $endDate = $request->filter_tanggal_sampai;
            $currentDate = Carbon::parse($startDate);

            while ($currentDate->lte($endDate)) {
                if ($request->filter_kehadiran == 0) {
                    $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                        ->where('kelas.id_kelas', $request->filter_kelas)
                        ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas');

                    if ($request->filter_nama != 0) {
                        $siswa->where('siswa.id_siswa', $request->filter_nama);
                    }


                    $absensi_siswa = Absensi_siswa::where('tanggal', $currentDate->format('Y-m-d'))->get();

                    foreach ($siswa->get()  as $s) {
                        if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()) {
                            $siswaFilter[] = $s;
                            $siswaFilter[count($siswaFilter) - 1]->tanggal = $currentDate->format('Y-m-d');
                            $siswaFilter[count($siswaFilter) - 1]->kehadiran = $absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->kehadiran;
                            $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = $absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->jam_hadir;
                        } else {
                            $siswaFilter[] = $s;
                            $siswaFilter[count($siswaFilter) - 1]->tanggal = $currentDate->format('Y-m-d');
                            $siswaFilter[count($siswaFilter) - 1]->kehadiran = null;
                            $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = null;
                        }
                    }
                } elseif ($request->filter_kehadiran == "tidak hadir") {
                    $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                        ->where('kelas.id_kelas', $request->filter_kelas)
                        ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas');

                    if ($request->filter_nama != 0) {
                        $siswa->where('siswa.id_siswa', $request->filter_nama);
                    }

                    $absensi_siswa = Absensi_siswa::where('tanggal', $currentDate->format('Y-m-d'))->get();

                    foreach ($siswa->get()  as $s) {
                        if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()) {
                        } else {
                            $siswaFilter[] = $s;
                            $siswaFilter[count($siswaFilter) - 1]->tanggal = $currentDate->format('Y-m-d');
                            $siswaFilter[count($siswaFilter) - 1]->kehadiran = null;
                            $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = null;
                        }
                    }
                } else {
                    $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                        ->where('kelas.id_kelas', $request->filter_kelas)
                        ->join('absensi_siswa', 'siswa.id_siswa', '=', 'absensi_siswa.id_siswa_absensi')
                        ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas', 'absensi_siswa.tanggal',  'absensi_siswa.kehadiran', 'absensi_siswa.jam_hadir as waktu_absensi')
                        ->where('absensi_siswa.tanggal', $currentDate->format('Y-m-d'))
                        ->where('absensi_siswa.kehadiran', $request->filter_kehadiran);

                    if ($request->filter_nama != 0) {
                        $siswa->where('siswa.id_siswa', $request->filter_nama);
                    }

                    if ($siswa->get()->count() > 0) {
                        $siswaFilter = array_merge($siswaFilter, $siswa->get()->toArray());
                    }

                }
                $currentDate->addDay(); // Increment the date by one day
            }
        }


        // return response()->json($siswaFilter);

        return  datatables()->of($siswaFilter)->make(true);
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


        $siswaFilter = [];

        if ($request->filter_tanggal_dari == $request->filter_tanggal_sampai) {
            if ($request->filter_kehadiran == 0) {
                $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                    ->where('kelas.id_kelas', $request->filter_kelas)
                    ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas');

                if ($request->filter_nama != 0) {
                    $siswa->where('siswa.id_siswa', $request->filter_nama);
                }


                $absensi_siswa = Absensi_siswa::where('tanggal', $request->filter_tanggal_dari)->get();

                foreach ($siswa->get()  as $s) {
                    if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()) {
                        $siswaFilter[] = $s;
                        $siswaFilter[count($siswaFilter) - 1]->tanggal = $request->filter_tanggal_dari;
                        $siswaFilter[count($siswaFilter) - 1]->kehadiran = $absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->kehadiran;
                        $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = $absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->jam_hadir;
                    } else {
                        $siswaFilter[] = $s;
                        $siswaFilter[count($siswaFilter) - 1]->tanggal = $request->filter_tanggal_dari;
                        $siswaFilter[count($siswaFilter) - 1]->kehadiran = null;
                        $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = null;
                    }
                }
            } elseif ($request->filter_kehadiran == "tidak hadir") {
                $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                    ->where('kelas.id_kelas', $request->filter_kelas)
                    ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas');

                if ($request->filter_nama != 0) {
                    $siswa->where('siswa.id_siswa', $request->filter_nama);
                }

                $absensi_siswa = Absensi_siswa::where('tanggal', $request->filter_tanggal_dari)->get();

                foreach ($siswa->get()  as $s) {
                    if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()) {
                    } else {
                        $siswaFilter[] = $s;
                        $siswaFilter[count($siswaFilter) - 1]->tanggal = $request->filter_tanggal_dari;
                        $siswaFilter[count($siswaFilter) - 1]->kehadiran = null;
                        $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = null;
                    }
                }
            } else {
                $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                    ->where('kelas.id_kelas', $request->filter_kelas)
                    ->join('absensi_siswa', 'siswa.id_siswa', '=', 'absensi_siswa.id_siswa_absensi')
                    ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas', 'absensi_siswa.tanggal',  'absensi_siswa.kehadiran', 'absensi_siswa.jam_hadir as waktu_absensi')
                    ->where('absensi_siswa.tanggal', $request->filter_tanggal_dari)
                    ->where('absensi_siswa.kehadiran', $request->filter_kehadiran);

                // dd($siswa->get());

                if ($request->filter_nama != 0) {
                    $siswa->where('siswa.id_siswa', $request->filter_nama);
                }
                // return response()->json($siswa->get());

                $siswaFilter = $siswa->get();
            }
        } else {

            $startDate = $request->filter_tanggal_dari;
            $endDate = $request->filter_tanggal_sampai;
            $currentDate = Carbon::parse($startDate);

            while ($currentDate->lte($endDate)) {
                if ($request->filter_kehadiran == 0) {
                    $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                        ->where('kelas.id_kelas', $request->filter_kelas)
                        ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas');

                    if ($request->filter_nama != 0) {
                        $siswa->where('siswa.id_siswa', $request->filter_nama);
                    }


                    $absensi_siswa = Absensi_siswa::where('tanggal', $currentDate->format('Y-m-d'))->get();

                    foreach ($siswa->get()  as $s) {
                        if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()) {
                            $siswaFilter[] = $s;
                            $siswaFilter[count($siswaFilter) - 1]->tanggal = $currentDate->format('Y-m-d');
                            $siswaFilter[count($siswaFilter) - 1]->kehadiran = $absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->kehadiran;
                            $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = $absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()->jam_hadir;
                        } else {
                            $siswaFilter[] = $s;
                            $siswaFilter[count($siswaFilter) - 1]->tanggal = $currentDate->format('Y-m-d');
                            $siswaFilter[count($siswaFilter) - 1]->kehadiran = null;
                            $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = null;
                        }
                    }
                } elseif ($request->filter_kehadiran == "tidak hadir") {
                    $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                        ->where('kelas.id_kelas', $request->filter_kelas)
                        ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas');

                    if ($request->filter_nama != 0) {
                        $siswa->where('siswa.id_siswa', $request->filter_nama);
                    }

                    $absensi_siswa = Absensi_siswa::where('tanggal', $currentDate->format('Y-m-d'))->get();

                    foreach ($siswa->get()  as $s) {
                        if ($absensi_siswa->where('id_siswa_absensi', $s->id_siswa)->first()) {
                        } else {
                            $siswaFilter[] = $s;
                            $siswaFilter[count($siswaFilter) - 1]->tanggal = $currentDate->format('Y-m-d');
                            $siswaFilter[count($siswaFilter) - 1]->kehadiran = null;
                            $siswaFilter[count($siswaFilter) - 1]->waktu_absensi = null;
                        }
                    }
                } else {
                    $siswa = Siswa::join("kelas", "siswa.id_kelas_siswa", "=", "kelas.id_kelas")
                        ->where('kelas.id_kelas', $request->filter_kelas)
                        ->join('absensi_siswa', 'siswa.id_siswa', '=', 'absensi_siswa.id_siswa_absensi')
                        ->select('siswa.id_siswa', 'siswa.nisn', 'siswa.nama_lengkap', 'siswa.alamat', 'kelas.nama_kelas', 'absensi_siswa.tanggal',  'absensi_siswa.kehadiran', 'absensi_siswa.jam_hadir as waktu_absensi')
                        ->where('absensi_siswa.tanggal', $currentDate->format('Y-m-d'))
                        ->where('absensi_siswa.kehadiran', $request->filter_kehadiran);

                    if ($request->filter_nama != 0) {
                        $siswa->where('siswa.id_siswa', $request->filter_nama);
                    }

                    if ($siswa->get()->count() > 0) {
                        $siswaFilter = array_merge($siswaFilter, $siswa->get()->toArray());
                    }

                }
                $currentDate->addDay(); // Increment the date by one day
            }
        }


        $data = [
            'tanggal_dari' => Carbon::parse($request->filter_tanggal_dari)->isoFormat('dddd, D MMMM Y'),
            'tanggal_sampai' => Carbon::parse($request->filter_tanggal_sampai)->isoFormat('dddd, D MMMM Y'),
            'kelas' => Kelas::find($request->filter_kelas)->nama_kelas,
            'nama' => Siswa::find($request->filter_nama)->nama_lengkap ?? "0",
            'kehadiran' => $request->filter_kehadiran,
            "siswa" => $siswaFilter,
        ];


        // return response()->json($data);
        // return view('absensi/absensi_laporan', $data);


        $pdf = Pdf::loadView('absensi/absensi_laporan', $data);

        return $pdf->stream();
    }
}
