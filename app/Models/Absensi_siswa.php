<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi_siswa extends Model
{
    use HasFactory;

    protected $table = 'absensi_siswa';
    protected $primaryKey = 'id_absensi';
    protected $fillable = [
        
        'id_siswa_absensi',
        'guru_id',
        'kehadiran',
        'tanggal',
        'jam_hadir'
    ];
    
    public $timestamps = false;

}
