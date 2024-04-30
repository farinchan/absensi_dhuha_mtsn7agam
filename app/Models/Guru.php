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
}
