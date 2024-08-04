<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    use HasFactory;

    protected $table = 'jadwal_piket';
    protected $primaryKey = 'id_piket';
    protected $fillable = [
        'id_guru',
        'hari',
    ];

    public $timestamps = false;
}
