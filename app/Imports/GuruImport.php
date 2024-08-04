<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;


class GuruImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Guru([
            'nip' => $row[0],
            'nama_lengkap' => $row[1], 
            'mapel' => $row[2], 
            'no_hp' => $row[3], 
            'username' => $row[4], 
            'password' => password_hash($row[5], PASSWORD_DEFAULT) ,
            'token' => Str::random(50),
        ]);
    }
}
