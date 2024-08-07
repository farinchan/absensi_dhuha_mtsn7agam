<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = [
        'nama_kelas',
        'guru_id',
    ];
    public $timestamps = false;

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas_siswa');
    }

}
