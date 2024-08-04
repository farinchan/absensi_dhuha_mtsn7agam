<?php

namespace App\Exports;

use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\FromCollection;

class KelasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kelas::join('guru', 'kelas.guru_id', '=', 'guru.id_guru')->select('kelas.id_kelas', 'kelas.nama_kelas', 'guru.nama_lengkap')->get();
    }
}
