<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Siswa::join('kelas', 'siswa.id_kelas_siswa', '=', 'kelas.id_kelas')
            ->select('siswa.nisn', 'siswa.nama_lengkap', 'kelas.nama_kelas', 'siswa.alamat')
            ->get();
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Nama Lengkap',
            'Kelas',
            'Alamat'
        ];
    }
}
