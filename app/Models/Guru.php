<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    protected $fillable = [
        'nip',
        'nama_lengkap',
        'mapel',
        'no_hp',
        'email',
        'username',
        'password',
    ];
    public function model(array $row)
    {
        return new Siswa([
            'nama' => $row[1],
            'nis' => $row[2], 
            'alamat' => $row[3], 
        ]);
    }
}
